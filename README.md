# Top Professores WebApp - Atividade Ponderada

Este repositório contém uma aplicação web simples em PHP integrada ao banco de dados `atividade_ponderada` hospedado no Amazon RDS (MySQL/MariaDB), seguindo as instruções do tutorial oficial da AWS: [Tutorial Web App com Amazon RDS](https://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/TUT_WebAppWithRDS.html).

## Estrutura do projeto

- **inc/dbinfo.inc**: arquivo com informações de conexão com o banco de dados (host, usuário, senha e nome do banco).
- **SamplePage.php**: página principal que permite adicionar e listar professores na tabela `TOP_PROFESSORES`.
- **README.md**: este arquivo, descrevendo o projeto.

## Banco de dados

O projeto contém a tabela:

**TOP_PROFESSORES**
- `id` INT AUTO_INCREMENT PRIMARY KEY
- `nome` VARCHAR(50)
- `estrelas` DECIMAL(2,1) DEFAULT 0.0
- `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP

## Funcionalidades

- Adicionar novos professores à tabela `TOP_PROFESSORES`.
- Listar todos os professores existentes, ordenados pelo ID.
- Formulário simples para entrada de dados diretamente na web.

## Como usar

1. Criar uma instância de banco de dados no Amazon RDS com MySQL ou MariaDB.
2. Criar a tabela `TOP_PROFESSORES` dentro do banco `atividade_ponderada` (o código PHP já inclui função para criar a tabela caso não exista).
3. Configurar o arquivo `inc/dbinfo.inc` com as credenciais corretas do banco.
4. Criar uma instância EC2 com Apache e PHP (conforme tutorial AWS).
5. Subir os arquivos do projeto para o diretório `/var/www/html/` da instância EC2.
6. Configurar o grupo de segurança da instância RDS para permitir acesso da instância EC2.
7. Acessar `http://<IP-da-instancia-EC2>/index.php` para usar a aplicação.

## Tecnologias utilizadas

- PHP
- MySQL / MariaDB
- HTML
- Apache (servidor web)
- Amazon RDS e EC2

## Video Demonstração

É possível encontra a demonstração comentada das instâncias, ferramentas usadas etc por meio deste [link](https://drive.google.com/file/d/1xQtXtZ-Olo5qpcVA4fCfC0rvcTwRlJz9/view?usp=sharing).

## Observações

- O arquivo `dbinfo.inc` **não deve ser compartilhado publicamente**, pois contém credenciais do banco.
- O tutorial da AWS usado como base está disponível em: [TUT_WebAppWithRDS](https://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/TUT_WebAppWithRDS.html).
