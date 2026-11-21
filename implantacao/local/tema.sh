#!/usr/bin/env bash
set -eu
cd "$(dirname "$0")"
dc=(docker compose -f compose.yaml -f compose.moodle.yaml)
cli=("${dc[@]}" exec -T --user www-data moodle php)
case "${1:-ativar}" in
  ativar)
    "${dc[@]}" up -d --no-build moodle cron web
    "${cli[@]}" admin/cli/upgrade.php --non-interactive
    "${cli[@]}" admin/cli/build_theme_css.php --themes=aieng
    "${cli[@]}" admin/cli/cfg.php --name=theme --set=aieng
    ;;
  boost)
    "${cli[@]}" admin/cli/cfg.php --name=theme --set=boost
    ;;
  *) echo 'Uso: bash tema.sh [ativar|boost]' >&2; exit 2 ;;
esac
"${cli[@]}" admin/cli/cfg.php --name=theme
