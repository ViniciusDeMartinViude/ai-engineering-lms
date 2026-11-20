# Programa de treinamento de AI Engineering — 6 semanas

Plano pedagógico para competidores do ESNC 2027. A sequência acompanha os seis módulos públicos da Technical Description, incluindo o apêndice da célula robótica. A duração proposta é de quatro horas semanais, 24 horas no total, mais plantões opcionais. A estimativa por semana é de 40 minutos de vídeo, 40 de leitura, 140 de prática e 20 para revisar e entregar. As 18 horas descritas para a prova representam o tempo de competição.

## Aulas no Moodle

Cada linha abaixo é uma aula assíncrona. O aluno encontra na mesma aula a gravação com legenda, o material teórico, os arquivos de prática e a atividade de entrega. Os títulos e demonstrações orientam a produção dos vídeos. Usar exemplos de treino e publicar as mídias no espaço restrito à turma.

| Semana / aula | Vídeo a gravar e objetivo | Material teórico | Exercício e evidência de aprendizagem |
|---|---|---|---|
| 1.1 • Capturar dados | Gravar a esteira e comparar iluminação, orientação e desfoque. Reconhecer onde faltam exemplos. | Guia de aquisição, inventário de classes e ficha de sessão. | Amostrar duas sequências, contar objetos por classe e documentar uma condição sub-representada. Entregar inventário com imagens de exemplo. |
| 1.2 • Anotar e dividir | Anotar objetos em movimento e rastrear o mesmo exemplar entre quadros. | Formato das caixas, coordenadas normalizadas e vazamento entre treino e validação. | Revisar caixas sobrepostas e dividir por sessão ou exemplar. Entregar manifesto dos conjuntos e demonstrar que os grupos são disjuntos. |
| 2.1 • Treinar uma referência | Executar uma primeira rodada de detecção e reproduzir a configuração. | Pesos iniciais, resolução, épocas, tamanho de lote, curvas e controle de versões. | Treinar com os dados da semana 1. Entregar configuração, versão dos dados, curvas e comando de reprodução. |
| 2.2 • Selecionar o modelo | Comparar dois modelos em um clipe reservado. Medir qualidade e latência. | Precisão, revocação, mAP, confiança e latência por quadro. | Comparar duas configurações nas mesmas condições, mostrar um falso positivo e uma omissão e justificar a escolha por classe e latência. |
| 3.1 • Estimar profundidade | Retificar um par estéreo, localizar correspondências e medir disparidade. | Distância focal em pixels, baseline, retificação e relação Z = fB/d. | Calcular profundidade em três pares conhecidos. Sinalizar um caso de disparidade inválida e explicitar as unidades. |
| 3.2 • Medir altura | Estimar o plano da esteira e converter posições para o referencial de trabalho. | Referenciais da câmera e da esteira, transformação, pontos de controle e erro absoluto. | Comparar alturas estimadas com referências físicas de treino. Entregar tabela em milímetros, erro médio e análise do pior caso. |
| 4.1 • Processar o fluxo ao vivo | Abrir fluxos de rede e reproduzir uma gravação com o mesmo cliente. Exibir classe, confiança, posição e altura. | Timestamps, pareamento de quadros, taxa de captura, filas e atraso. | Medir latência com o método documentado, observar quadros atrasados e explicar quando descartar um par. Entregar log e captura da interface. |
| 4.2 • Contar cada objeto uma vez | Interromper um fluxo, reconectar e acompanhar um objeto em vários quadros. | Identidade de eventos, estados, perda de sinal e prevenção de duplicatas. | Reproduzir um clipe rotulado e uma interrupção. Comparar eventos esperados e obtidos, registrar a reconexão e quantificar duplicatas. |
| 5.1 • Integrar o simulador | Converter uma detecção em alvo e interpretar a resposta da API documentada. | Referenciais, tempo de deslocamento na esteira, limites operacionais e confirmação de comandos. | No simulador, testar um alvo válido, um inválido e uma falha de comunicação. Entregar decisões e respostas com timestamps. |
| 5.2 • Validar o ciclo completo | Acompanhar um objeto da captura à decisão e ao resultado da ação. | Reconciliação de eventos, parada de emergência e ensaio supervisionado em célula autorizada. | Executar sequência conhecida no simulador e, se houver acesso autorizado, na célula. Entregar rastreio por objeto e explicar cada ação omitida ou repetida. |
| 6.1 • Resolver um problema novo | Ler um enunciado independente da esteira e construir um baseline com dados de prática. | Variável-alvo, escolha de métrica, divisão dos dados e formato de saída. | Entregar notebook reexecutável com baseline, métrica e uma limitação. Usar domínio e dados didáticos escolhidos para a aula. |
| 6.2 • Simulado individual | Mostrar em um exemplo curto como distribuir o tempo, congelar artefatos e verificar o formato das previsões. | Checklist de submissão e ficha de retrospectiva. | Em 120 minutos de prática, resolver uma tarefa inédita de treino. Entregar previsões, modelo, comando de execução e justificativa. O domínio e os dados oficiais do módulo surpresa permanecem reservados. |

## Feedback e acompanhamento

Ao final de cada semana, o treinador registra no Moodle a evidência avaliada, uma correção prioritária e o que o aluno deve demonstrar em nova tentativa. Usar como critérios observáveis a separação dos dados (S1), a decisão sustentada por métricas (S2), o erro geométrico em unidades físicas (S3), a confiabilidade dos eventos (S4), o rastreio das ações (S5) e a reprodução independente das previsões (S6). Definir e publicar os limiares de cada exercício antes da entrega. As rubricas são formativas.

## Sessões on-line de dúvidas

O treinador publica a disponibilidade semanal no fuso de Abu Dhabi. O aluno usa “Agendar sessão de dúvidas” no Moodle, escolhe um horário e indica a aula, a tentativa feita e sua dúvida. A duração sugerida é de 20 minutos. O aluno recebe um convite individual com o link da reunião e pode remarcar. Depois da sessão, registra a próxima tentativa na atividade correspondente.

## Preparação editorial

Para cada aula, produzir roteiro, gravação legendada, leitura, arquivos de prática, enunciado e referência de correção restrita ao treinador. Antes da publicação, conferir o áudio, abrir os recursos com perfil de aluno, executar o exercício a partir das instruções e testar o envio da evidência. O responsável pela disciplina aprova a aula antes da liberação da semana.
