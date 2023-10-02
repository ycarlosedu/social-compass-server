# <span style="color:orange">SOCIAL COMPASS</span> PHP API

Projeto responsável pelo sistema de backend da rede social da COMPASS (projeto de estudos).

## Requisitos do Projeto
- [Composer](https://getcomposer.org/) instalado na máquina;
- [Mysql 5.7+](https://dev.mysql.com/downloads/workbench/) instalado e com banco de dados e usuário criado (tutorial abaixo);
- [Xampp](https://www.apachefriends.org/download.html) (PHP 8.1.17) instalado para rodar o server MySQL;

## Configurando o DB de acordo com o .env
- Execute o painel de controle do Xampp, clique no botão de start referente ao MySQL, ele irá mostrar a porta que o mysql está rodando (por padrão 3306);
- Abra o MySql Workbench e crie uma MySQL Connection com as seguintes configurações:
```
Connection Name: Qualquer nome que preferir
Host name: 127.0.0.1 
Username: root
Password: em branco, se quiser utilizar, inserir no .env
Port number: 3306
Database/Schema (Após criar a Connection): social_compass
```
- Estas configurações estão setadas no .env, podem ser alteradas se preferir

### Instalação
1 - Clonando o repositório (clonar dentro da pasta C:\xampp\htdocs):
```bash
$ git clone https://github.com/ycarlosedu/social-compass-server.git
```
3 - Baixando as dependências necessárias ao projeto:
```bash
$ composer install
```
6 - Rodando migrações (irá criar as tabelas no DB):
```bash
$ composer migrate
```
7 - Copiando configs do PHP:
```bash
$ xcopy "C:\xampp\htdocs\social-compass-server\php.ini" "C:\xampp\php"
$ ou copie o arquivo php.ini que deixei de exemplo na raiz deste projeto para dentro da pasta C:\xampp\php
```
8 - Iniciando servidor da API (em composer.json está setado para iniciar em http://localhost:8000):
```bash
$ composer start
```

## Informações adicionais

- Rotas de requests ficam no arquivo routes/web.php;
- Os controllers responsáveis pelas lógicas das requests estão em app/Http/Controllers
- Responses padrões de erro em PT-BR estão em fase de configuração, ainda não funcionando.

## Branches

O projeto segue as politicas do `git-flow`:

- fix/description (Ajustes, correções de bugs)
- tests/description (Novos testes)
- feat/description (Novos desenvolvimentos)
- refactor/description

## Alguns Comandos

- `composer create-migration`
  - Cria uma nova migration em database/migrations para alterar/criar tabelas no DB
- `composer rollback-migration`
  - Desfaz a última migration rodada no DB.
