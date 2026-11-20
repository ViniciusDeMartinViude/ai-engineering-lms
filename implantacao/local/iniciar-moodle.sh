#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")"
umask 077
test -s .secrets/postgres_password || { echo 'Conclua o laboratório 1 nesta pasta.' >&2; exit 1; }
mkdir -p .secrets
exec 9>.secrets/install.lock
flock -n 9 || { echo 'Outra instalação está em andamento.' >&2; exit 1; }
if [[ ! -e .secrets/moodle.env ]]; then
  printf 'MOODLE_DB_PASSWORD=%s\n' "$(openssl rand -hex 32)" > .secrets/moodle.env
fi
dbpass=$(sed -n 's/^MOODLE_DB_PASSWORD=//p' .secrets/moodle.env)
[[ $dbpass =~ ^[a-f0-9]{64}$ ]] || { echo 'Arquivo moodle.env inválido.' >&2; exit 1; }
dc=(docker compose -f compose.yaml -f compose.moodle.yaml)
"${dc[@]}" config --quiet
"${dc[@]}" build moodle web
"${dc[@]}" up -d --wait db mailpit
sql=("${dc[@]}" exec -T db psql -X -qAt -v ON_ERROR_STOP=1 -U postgres -d moodle)
if [[ $("${sql[@]}" -c "SELECT count(*) FROM pg_roles WHERE rolname='moodle_app'") == 0 ]]; then
  printf "CREATE ROLE moodle_app LOGIN PASSWORD '%s';\n" "$dbpass" | "${sql[@]}"
fi
"${sql[@]}" -c 'GRANT CONNECT,TEMPORARY ON DATABASE moodle TO moodle_app; GRANT USAGE,CREATE ON SCHEMA public TO moodle_app;'
count=$("${sql[@]}" -c "SELECT count(*) FROM pg_tables WHERE schemaname='public'")
run=("${dc[@]}" run --rm -T --no-deps --user www-data moodle)
if [[ $count == 0 ]]; then
  if [[ ! -s .secrets/moodle-admin ]]; then
    printf 'Aa1!%s\n' "$(openssl rand -hex 20)" > .secrets/moodle-admin
  fi
  "${run[@]}" sh -c 'read -r pw && exec php admin/cli/install_database.php --agree-license --fullname="AI Engineering LMS" --shortname=AI-LMS --adminuser=admin --adminemail=admin@example.test --adminpass="$pw"' < .secrets/moodle-admin
  "${run[@]}" touch /srv/moodledata/.installed-local
else
  "${run[@]}" test -f /srv/moodledata/.installed-local || { echo 'Banco já populado sem marcador de instalação completa. Verifique a tentativa anterior e o volume moodledata.' >&2; exit 1; }
fi
"${dc[@]}" up -d moodle web cron
"${dc[@]}" ps
