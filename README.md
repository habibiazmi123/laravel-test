# REST API

## Project Overview

This project is a simple RESTful API built with the Laravel framework that manages users and their related data. The API provides functionality to create users and retrieve a paginated list of users.

## Main Feature

- **API for get list users**
```
GET http://localhost:8000/api/users
```
- **API for create user**
```
POST http://localhost:8000/api/users
```

## Getting Started

### 1. Clone repository

```bash
git clone https://github.com/habibiazmi123/laravel-test
cd laravel-test
```

### 2. Setting Env

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 3. Migration & Seed

```bash
php artisan migrate
php artisan db:seed
```

### 4. Running apps

```bash
composer run dev
```

### 5. Access apps
```bash
http://localhost:8000

http://localhost:8000/docs/api (api documentation)
```
