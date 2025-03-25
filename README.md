# Kodano – Recruitment Task: REST API

## Tech Stack

- Symfony
- MySQL
- API Platform
- Docker & Docker Compose

## How to Run

### 1. Clone the repo

git clone https://github.com/overcod3d/kodano.git

cd kodano

### 2. Build Docker images

docker compose build --no-cache

### 3. Start the containers

docker compose up --wait

### 4. Access the app

- Homepage: https://localhost/
- API: https://localhost/api
- Swagger docs: https://localhost/docs
- Admin panel: https://localhost/admin

## Run Tests

docker compose exec -T php bin/phpunit
