# Laboratório 2 • Moodle no navegador

Partindo do laboratório PostgreSQL/Mailpit, abra o Ubuntu WSL no mesmo clone e execute:

```bash
cd ~/projetos/ai-engineering-lms/implantacao/local
git pull --ff-only
bash iniciar-moodle.sh
```

O primeiro build baixa Moodle 5.3.1, instala extensões PHP e resolve as dependências. O script usa o projeto Compose existente, cria uma conta PostgreSQL dedicada e inicializa o volume de arquivos do Moodle. Use a mesma pasta e o mesmo COMPOSE_PROJECT_NAME do laboratório 1. Em uma segunda execução, o script verifica o marcador da instalação e preserva o banco existente.

Abra http://localhost:8080 e entre com o usuário `admin`. Consulte a senha inicial somente no terminal local com `cat .secrets/moodle-admin`. Confirme que a página de administração carrega com os estilos visuais. Em Site administration → Server → Email → Outgoing mail configuration, use o teste de e-mail para enviar a aluno@example.test. Confira a mensagem em http://localhost:8025 (ou na porta configurada no primeiro laboratório).

Para verificar a execução do cron:

```bash
docker compose -f compose.yaml -f compose.moodle.yaml logs --tail=40 cron
```

Para parar a pilha preservando os volumes:

```bash
docker compose -f compose.yaml -f compose.moodle.yaml down
```

Se a porta 8080 estiver ocupada, defina `MOODLE_PORT=8081` no arquivo local `.env` antes da primeira inicialização e acesse essa porta. Para diagnosticar um erro de inicialização, preserve o primeiro erro exibido pelo script e consulte os logs de `db`, `moodle` e `web` com os dois arquivos Compose acima. Não publique arquivos de `.secrets`.
