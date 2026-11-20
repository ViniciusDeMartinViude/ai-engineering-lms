# Laboratório 1 • PostgreSQL e Mailpit

Primeira entrega da issue #1. Teste estes dois serviços antes de acrescentar PHP, Moodle, Nginx e cron. Execute no Linux ou no terminal Ubuntu do WSL 2 com Docker Desktop em execução e integração com a distribuição habilitada.

1. Na pasta `implantacao/local`, verifique `docker version` (Client e Server) e `docker compose version`. A primeira execução precisa baixar as imagens.
2. Gere o segredo local uma vez. Reutilize o mesmo arquivo nas próximas execuções.

```bash
mkdir -p .secrets
(umask 077; set -C; openssl rand -hex 32 > .secrets/postgres_password)
```

Se o arquivo já existir, o shell recusará a sobrescrita. Essa é a senha administrativa do PostgreSQL. O Moodle receberá uma conta própria na etapa de instalação.

3. Suba os serviços e consulte a versão e o banco pelo cliente interno.

```bash
docker compose config --quiet
docker compose up -d --wait
docker compose ps
docker compose exec -T db psql -U postgres -d moodle -c "SELECT current_database(), version();"
```

4. Abra http://localhost:8025 no navegador do PC. Para verificar o recebimento de SMTP pela rede interna, execute o comando abaixo. Ele inicia um cliente temporário na rede do serviço Mailpit e envia uma mensagem de teste.

```bash
docker run --rm --network "container:$(docker compose ps -q mailpit)" python:3.13-alpine python -c "import smtplib; s=smtplib.SMTP('127.0.0.1',1025,timeout=10); s.sendmail('lab@example.test',['aluno@example.test'],'Subject: Teste LMS\r\n\r\nSMTP local OK'); s.quit()"
```

5. A mensagem **Teste LMS** deve aparecer na caixa. Para encerrar, use `docker compose down`. O volume do banco é preservado. As mensagens de teste do Mailpit são temporárias. Para repetir, use `docker compose up -d --wait`.

Se o Docker não responder, inicie o Docker Desktop e confira a integração WSL. Se a porta 8025 estiver ocupada, crie um arquivo local `.env` com `MAILPIT_PORT=8026`, repita a subida e abra localhost:8026. Para diagnosticar falha de inicialização, consulte `docker compose logs --tail=50 db mailpit`.
