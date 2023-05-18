# Reserva.me - Sistema de Reservas para Restaurantes

O Reserva.me é um sistema de reservas para restaurantes. O projeto é um desafio proposto para uma vaga de Desenvolvedor. O objetivo era construir um sistema de reserva para um restaurante com 15 mesas.

## Tecnologias Utilizadas

-   Frontend: HTML, CSS (Tailwind CSS) e JavaScript (Vue.js).
-   Backend: PHP 8.1, Laravel 10.
-   Banco de dados: PostgreSQL.
-   Outros: Docker, Laravel Breeze para autenticação, Vite para compilação de assets.

## Requisitos

O sistema inclui os seguintes recursos:

-   Sistema de login de usuários.
-   Reservas de mesa permitidas das 18:00 às 23:59, exceto aos domingos.
-   Validações para evitar que reservas possuam horários conflituosos.
-   Painel administrativo simples exibindo dias e horários reservados, e por quem.

## Banco de Dados

-   O banco de dados é relacional e foi criado utilizando PostgreSQL.
-   Utiliza Migrations do Laravel para a criação de tabelas.
-   Seeds e Factories do Laravel foram utilizados para popular o banco de dados para fins de testes.

## Execução Local

Pré-requisitos: Docker e Docker Compose instalados.

### Clone o repositório

```sh
git clone https://github.com/adensoares/reserva-me.git
```

### Navegue até o diretório do projeto:

```sh
cd reserva-me
```

### Configure o ambiente

Copie o arquivo .env.example para .env:

```sh
cp .env.example .env
```

Atualize as variáveis de ambiente no arquivo .env para corresponder ao seu ambiente de desenvolvimento:

```dosini
APP_NAME=Reserva.me
APP_URL=http://localhost:8989

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=seu_db
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### Inicie os containers Docker

```sh
docker-compose up -d
```

### Acesse o container da aplicação

```sh
docker-compose exec app bash
```

### Instale as dependências do projeto

Dentro do container, instale as dependências do Laravel com o composer:

```sh
composer install
```

### Instale as dependências do Front-end

```sh
npm install
```

### Inicie o servidor de desenvolvimento (Vite):

```sh
npm run dev
```

### Gere a chave de aplicação

Ainda dentro do container, gere a chave de aplicação do Laravel:

```sh
php artisan key:generate
```

Agora, você deve ser capaz de acessar o sistema de reservas em http://localhost:8989.

## Testes

Os testes foram escritos utilizando o PHPUnit do Laravel e são referente apenas ao fluxo de reserva do sistema. Foram criados quatro testes:

-   test_reservation_page_is_displayed: Verifica se a página de reserva é exibida corretamente.
-   test_reservation_can_be_created: Verifica se uma reserva pode ser criada com sucesso.
-   test_reservation_can_be_updated: Verifica se uma reserva existente pode ser atualizada.
-   test_reservation_can_be_deleted: Verifica se uma reserva existente pode ser excluída.

Para executar o arquivo de testes basta utilizar o comando:

```sh
php artisan test --filter ReservationTest
```
