# AI Engineering Studio

Tema filho do Boost para Moodle 5.3. A composição gráfica do login representa a sobreposição dos campos de visão de duas câmeras. Os cabeçalhos e as seções de curso usam o mesmo detalhe azul-petróleo. O curso, as atividades e seus nomes continuam configuráveis no Moodle.

No laboratório já instalado, execute a partir de `implantacao/local`:

```bash
git pull --ff-only
MOODLE_PORT=9090 bash tema.sh ativar
```

O Compose monta a pasta do tema em modo de leitura no PHP, cron e Nginx. A atualização CLI registra os plugins pendentes e compila o tema antes da seleção. Entre em http://localhost:9090/my/ para conferir o painel. Abra o login em uma janela privativa para conferir a arte. Para voltar ao tema padrão, execute `bash tema.sh boost`.

## Portal 2.0

A navegação lateral aparece nas páginas de trabalho de usuários autenticados a partir de 1200 px. Em telas menores, abra o menu do Studio acima do título. O painel apresenta até três cursos em que o usuário está matriculado e o calendário. Sem matrícula, o cartão aponta para o catálogo. Os links de gestão da barra respeitam as permissões do usuário.
