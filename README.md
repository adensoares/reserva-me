# Reserva.me - Sistema de Reservas para Restaurantes

O Reserva.me é um sistema de reservas para restaurantes construído com Laravel e Vue.js.

## Instruções de instalação

### Clone o repositório

```sh
git clone https://github.com/adensoares/reserva-me.git
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

### Gere a chave de aplicação

Ainda dentro do container, gere a chave de aplicação do Laravel:

```sh
php artisan key:generate
```

Agora, você deve ser capaz de acessar o sistema de reservas em http://localhost:8989.
