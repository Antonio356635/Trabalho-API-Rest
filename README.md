# Trabalho API Rest com Slim Framework

Este projeto é uma API REST desenvolvida em PHP utilizando o micro-framework **Slim v4**. Ela simula o gerenciamento de um cadastro de produtos com todas as operações básicas (CRUD).

## 🚀 Métodos Disponíveis na API

A API trabalha com os seguintes caminhos (rotas):

* **GET /produtos** - Lista todos os produtos cadastrados.
* **GET /produtos/{id}** - Busca as informações de um produto específico pelo ID.
* **POST /produtos** - Cadastra um novo produto no sistema.
* **PUT /produtos/{id}** - Atualiza os dados de um produto existente.
* **DELETE /produtos/{id}** - Remove um produto do sistema.

## 🛠️ Como rodar o projeto localmente

1. Baixe os arquivos do projeto ou faça um clone do repositório.
2. Instale as dependências do PHP rodando o comando:
   ```bash
   composer install
   ```
3. Inicie o servidor embutido do PHP:
   ```bash
   php -S localhost:8000
   ```
4. A API estará pronta para testes no endereço `http://localhost:8000/produtos`.
