# Job Board Application

This is a personal project in which employers can create and manage their job posts. Authenticated users can apply for the jobs and then manage their job applications. Laravel 11, Blade templates, Tailwind CSS and Alpine.js are used to develop the system.

## Run Locally

Run a MySQL Databaase using Docker

```bash
  docker compose up
```

Make a .env file from .env.example

```bash
  cp .env.example .env
```

Install dependencies, generate encryption key and create the Job Board database

```bash
  composer install
  npm install
  php artisan key:generate
  php artisan migrate --seed
```

Start the local server

```bash
  npm run dev
  php artisan serve
```
