# Deckly — Sistema Web

O Deckly é um projeto de sistema web para gerenciamento e comercialização de produtos colecionáveis, desenvolvido para uma loja de cartas colecionáveis.

## Funcionalidades

* Vitrine de produtos, com pesquisa, filtros e paginação.
* Painel administrativo.
* Gerenciamento de produtos, categorias e marcas.
* Cadastro e gerenciamento de clientes e funcionários.
* Controle de estoque e preços promocionais.
* Integração com banco de dados MySQL.

## Tecnologias utilizadas

* PHP
* HTML
* CSS
* JavaScript
* MySQL

## Telas

<img width="1860" height="952" alt="Captura de tela 2026-10-23 113034" src="https://github.com/user-attachments/assets/dd0e60bb-2647-4464-82e5-7984a2f003f6" />
<img width="1864" height="992" alt="Captura de tela 2026-10-23 113224" src="https://github.com/user-attachments/assets/a8e6154b-c5fa-481a-af68-b9ada9a87a74" />


## Banco de dados

O arquivo SQL de demonstração está disponível na pasta `database`.
Importe o banco de dados no MySQL e configure a conexão no arquivo correspondente antes de executar o projeto.

## Como executar

1. Instale um ambiente local com PHP e MySQL (por exemplo, o XAMPP).
2. Clone este repositório e coloque a pasta do projeto no diretório do servidor (no XAMPP, a pasta `htdocs`).
3. Importe o arquivo SQL da pasta `database` no MySQL.
4. Configure a conexão com o banco de dados (servidor, usuário, senha e nome do banco) no arquivo de conexão do projeto.
5. Inicie o Apache e o MySQL e acesse o projeto pelo navegador, em `http://localhost/INFO_53/` seguido do nome da pasta do projeto.

## Observação

Este projeto utiliza dados de demonstração. Configure o ambiente local antes de executar o sistema.

Faz parte do ecossistema Deckly, que também possui uma [versão desktop](https://github.com/mariadegaspari/deckly-desktop).

O projeto também precisa estar dentro do caminho: xampp/htdocs/INFO_53/Deckly/ (Se não estiver dessa forma, o upload de imagens do sistema desktop não funcionará).
