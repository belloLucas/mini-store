# Mini Store

Uma plataforma moderna de e-commerce construída com Laravel e Vue.js, apresentando catálogo de produtos, funcionalidade de carrinho de compras e processo de checkout.

## Respostas das perguntas no arquivo <a href="https://github.com/belloLucas/mini-store/blob/main/respostas.md">respostas.md</a>

## 📋 Funcionalidades

-   Catálogo de produtos com filtragem por categoria
-   Carrinho de compras com armazenamento persistente
-   Autenticação de usuários
-   Painel administrativo para gerenciamento de produtos
-   Processo de checkout

## 🛠️ Tecnologias

-   **Backend:** Laravel 12
-   **Frontend:** Vue 3 com Inertia.js
-   **Gerenciamento de Estado:** Pinia
-   **Estilização:** TailwindCSS
-   **Banco de Dados:** PostgreSQL

## 📦 Instalação

### Pré-requisitos

-   PHP 8.2 ou superior
-   Composer
-   Node.js e npm
-   Banco de dados (MySQL, PostgreSQL ou SQLite)

### Configuração

1. Clone o repositório:
    ```bash
    git clone https://github.com/belloLucas/mini-store.git
    cd mini-store
    ```
2. Instale as dependências PHP:
    ```bash
    composer install
    ```
3. Instale as dependências Javascript:

    ```bash
    npm install
    ```

4. Crie uma cópia do arquivo de ambiente

    ```bash
    cp .env.example .env
    ```

5. Gere uma chave de aplicação:

    ```bash
    php artisan key:generate
    ```

6. Configure o banco de dados no arquivo .env:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    6DB_PORT=330
    DB_DATABASE=mini_store
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7. Execute as migrations e popule o DB:
    ```bash
    php artisan migrate --seed
    ```

### Executando a Aplicação

1. Executando o Front End

    ```bash
    npm run dev
    ```

2. Executando o Back End

    ```bash
    php artisan serve
    ```

3. A aplicação estará rodando na url

    ```bash
    http://localhost:8000
    ```

## Estrutura do Projeto

-   /app - Código principal da aplicação (Back End)
-   /resources/js - Componentes Vue.js e páginas (Front End)
    -   /Pages - Páginas principais da aplicação
    -   /Components - Componentes reutilizáveis
    -   /stores - Stores Pinia para gerenciamento de estado
-   /database/migrations - Estrutura do Banco de Dados
-   /database/seeders - Seeders de dados
