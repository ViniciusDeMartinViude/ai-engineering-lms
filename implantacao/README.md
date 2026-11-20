# Implantação técnica do LMS

Plano operacional para homologação local e publicação posterior. O piloto funciona independentemente da reformulação do AI Assessment Studio.

## Primeira implantação — laboratório local

Implementar a pilha em um PC Linux com Docker Engine ou Windows com Docker Desktop e WSL 2. Para o teste inicial, publicar o Nginx em `127.0.0.1:8080` e usar `http://localhost:8080` como endereço canônico do Moodle. Capturar e-mails com Mailpit e manter o PostgreSQL na rede interna do Compose. Para o ensaio com a turma, configurar um endereço estável na LAN, ajustar o endereço canônico e permitir acesso apenas pela rede do laboratório.

Usar volumes nomeados para banco e moodledata. Verificar persistência após recriar os contêineres. Restaurar uma cópia em outro projeto Compose com volumes independentes. Executar uma entrega, correção e consulta de feedback antes de passar ao teste com 14 contas.

## Segunda implantação — cloud e domínio existente no Cloudflare

| Recurso | Mínimo do piloto | Recomendado |
| --- | --- | --- |
| CPU | 2 vCPU | 4 vCPU |
| RAM | 4 GB | 8 GB |
| SSD | 80 GB | 120 GB |
| GPU | Dispensável | Dispensável |
| Backup | Diário, fora da VM | Diário, retenção inicial de 30 dias e restauração ensaiada |

Estimativa para 14 competidores com banco na mesma VM, arquivos de até 100 MB no Moodle e vídeos, datasets e pesos grandes em armazenamento autenticado. Validar o tamanho com 14 submissões concorrentes em homologação. Usar Linux x86-64, IP estável, DNS, HTTPS, SMTP de saída e acesso administrativo restrito. Escolher uma região aprovada pela instituição e incluir VM, SSD, backups, egress e SMTP no orçamento.

## Docker Compose

| Serviço | Configuração proposta |
| --- | --- |
| web | Nginx com raiz Moodle public/. Porta 8080 local para testes. HTTPS na implantação cloud |
| moodle | PHP 8.4 FPM, OPcache, Composer, Moodle 5.3 LTS com versão de manutenção fixada |
| cron | Mesma imagem do Moodle, cron CLI a cada minuto e volume moodledata compartilhado |
| db | PostgreSQL 17, rede privada e volume persistente |

PHP 8.3 é o mínimo oficial. Habilitar sodium, extensões para PostgreSQL e Moodle e max_input_vars >= 5000. Manter moodledata fora da raiz web. Fixar versões de imagens e dependências. Usar segredos fora do Git, health checks, volumes persistentes e configuração distinta para desenvolvimento e produção. Validar os limites de upload em Nginx, PHP e Moodle.

Backup com pg_dump, moodledata e configuração de recuperação, armazenados com criptografia fora da VM via restic e armazenamento de objetos. Ensaiar restauração isolada. Metas iniciais: RPO 24 h e RTO 4 h. Monitorar HTTPS, disco, cron e idade do último backup.

## Ferramentas

- Infraestrutura: Docker Engine, Compose v2, Git, Nginx, TLS/ACME, PHP FPM, Composer, PostgreSQL, restic e armazenamento de objetos.
- Operação: SMTP, monitoramento externo, GitHub Issues e Actions. Microsoft Entra ID se o login institucional estiver disponível.
- Laboratório: Python, PyTorch, Ultralytics, OpenCV, VS Code ou JupyterLab, Git, simulador MaxArm e gravações estéreo.
- Validação: k6 para carga com contas de teste em homologação e GitHub Actions para validar Compose e build.

## Marcos de implantação técnica

| Etapa | Entregas | Aceite |
| --- | --- | --- |
| T1 | Compose local, Mailpit, cron, volumes e restauração | Instalação local limpa, e-mail capturado, cron ativo e restauração verificada |
| T2 | Configurar perfis, matrícula, recursos de vídeo, materiais, tarefas e agenda | Testar acesso como aluno e devolução de feedback pelo treinador |
| T3 | Montar curso de homologação com vídeo, leitura, exercício e link de plantão | Validar reprodução, entrega, nota e reserva com conta de teste |
| T4 | Simulado, carga, permissões, exportação de notas e ensaio de indisponibilidade | 14 submissões registradas; teste de acesso e metas de restauração aprovados |
| Após aceite local | Implantar a imagem validada na VM e publicar pelo domínio existente no Cloudflare | HTTPS, login, entrega, e-mail e cron verificados pelo endereço final |
| Após definição do novo Studio | Avaliar integração de resultados Studio → Moodle | Reenvio é idempotente; resultado registra ID da entrega, versão do avaliador e relatório |

O Moodle é o registro oficial da nota. No piloto, o treinador lança o resultado com rubrica. Quando a nova versão do Studio tiver uma interface documentada, a automação pode usar LTI 1.3 se o Studio implementar os serviços necessários ou um serviço web com permissões específicas. Código de competidores roda em ambiente isolado no laboratório. Materiais reservados, entregas e credenciais ficam em serviços com acesso controlado.

## Publicação e recuperação

1. Após o aceite local, criar a VM e provisionar volumes novos, segredos de produção, SMTP real, backup externo e monitoramento.
2. Implantar a mesma imagem validada. Exportar o curso piloto sem dados dos usuários de teste e restaurá-lo na instância de produção.
3. Escolher um subdomínio livre, por exemplo `lms`, na zona Cloudflare existente. Configurar o nome definitivo no Moodle, instalar na origem um certificado válido para esse nome e criar o registro DNS com proxy apontando para a VM. Usar TLS Full (strict) para o host, preservando a configuração dos demais serviços do domínio.
4. Validar login, links dos materiais, upload, correção, e-mail e cron pelo endereço final. Se o teste falhar, suspender a abertura da turma e reverter a publicação do subdomínio. Manter o ambiente local disponível para diagnóstico.

## Configuração das aulas e do atendimento

Criar uma seção Moodle por semana e duas aulas por seção. Em cada aula, criar uma Página com o vídeo e a leitura e uma Tarefa com instruções, evidência esperada, prazo e rubrica. Usar grupos e matrículas para controlar o acesso. No laboratório, servir um vídeo de amostra na rede local; em produção, hospedar as gravações em armazenamento institucional com permissão da turma. Testar reprodução e legendas como aluno, inclusive fora da LAN.

Criar o recurso URL “Agendar sessão de dúvidas” no topo do curso. Se o Microsoft 365 institucional tiver Bookings e Teams habilitados, configurar o serviço de atendimento com o treinador como responsável, disponibilidade fornecida por ele, fuso Asia/Dubai e reunião on-line. O aluno escolhe uma vaga e recebe a confirmação e o link de entrada. Se Bookings estiver indisponível, usar uma atividade Escolha no Moodle, com uma opção por horário, limite de um aluno por vaga e alteração permitida até o prazo; o treinador envia o convite individual pelo Teams.

Antes de liberar a turma, usar dois alunos de teste para reservar a mesma vaga, confirmar que apenas um consegue, cancelar ou remarcar e verificar a liberação da vaga. Testar a chegada do convite e a entrada na chamada. As confirmações de um serviço externo são verificadas em caixas de teste desse serviço. O Mailpit captura apenas o e-mail enviado pelo Moodle local.

## Referências

- [Moodle 5.3 e requisitos](https://moodledev.io/general/releases/5.3)
- [Instalação do Moodle](https://docs.moodle.org/503/en/Install)
- [Competências](https://docs.moodle.org/503/en/Competencies)
- [Ferramentas externas LTI](https://docs.moodle.org/503/en/LTI_External_tool)
