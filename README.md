# To-Do List REST API

Этот проект представляет собой REST API для управления задачами (To-Do List). Он был создан как тестовый проект для портфолио и демонстрирует основные возможности Laravel, включая аутентификацию, CRUD-операции, фильтрацию и сортировку.

## Основные функции

- **Аутентификация через API-токены**: Пользователи могут регистрироваться, входить в систему и выходить из неё.
- **Управление задачами**:
  - Создание, чтение, обновление и удаление задач (CRUD).
  - Фильтрация задач по статусу выполнения.
  - Сортировка задач по полям.
- **Тестирование**: Проект включает полный набор тестов для всех функций API.

## Технологии

- **Laravel 11**
- **Laravel Sanctum**
- **SQLite**
- **PHPUnit**

---

## Установка и настройка

### 1. Клонирование репозитория

Склонируйте репозиторий на ваш компьютер:

```bash
git clone https://github.com/dknz22/todo-api.git
cd [folder]
```

### 2. Установка зависимостей

Установите все зависимости через Composer:

```bash
composer install
```

### 3. Настройка окружения

Скопируйте файл .env.example в .env:
```bash
cp .env.example .env
```

Настройте подключение к базе данных:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Генерация ключа приложения

```bash
php artisan key:generate
```

### 5. Запуск миграций

```bash
php artisan migrate
```

### 6. Установка Laravel Sanctum

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

### 7. Запустите миграцию

```bash
php artisan migrate
```

# Эндпоинты

### Аутентификация

#### POST: /api/register
- **Input**:
  - `name`: string
  - `email`: string
  - `password`: string
  - `password_confirmation`: string
- **Output**:
  - `user`: object
    - `id`: int
    - `name`: string
    - `email`: string
    - `created_at`: string
    - `updated_at`: string
  - `token`: string

#### POST: /api/login
- **Input**:
  - `email`: string
  - `password`: string
- **Output**:
  - `user`: object
    - `id`: int
    - `name`: string
    - `email`: string
    - `created_at`: string
    - `updated_at`: string
  - `token`: string

#### POST: /api/logout
- **Input**: Нет
- **Output**:
  - `message`: string

---

### Управление задачами

#### GET: /api/tasks
- **Input** (опциональные параметры запроса):
  - `completed`: boolean
  - `sort`: string
- **Output**:
  - Массив объектов:
    - `id`: int
    - `title`: string
    - `description`: string
    - `completed`: boolean
    - `created_at`: string
    - `updated_at`: string

#### POST: /api/tasks
- **Input**:
  - `title`: string
  - `description`: string (опционально)
- **Output**:
  - `id`: int
  - `title`: string
  - `description`: string
  - `completed`: boolean
  - `created_at`: string
  - `updated_at`: string

#### GET: /api/tasks/{id}
- **Input**: Нет
- **Output**:
  - `id`: int
  - `title`: string
  - `description`: string
  - `completed`: boolean
  - `created_at`: string
  - `updated_at`: string

#### PUT: /api/tasks/{id}
- **Input**:
  - `title`: string (опционально)
  - `description`: string (опционально)
  - `completed`: boolean (опционально)
- **Output**:
  - `id`: int
  - `title`: string
  - `description`: string
  - `completed`: boolean
  - `created_at`: string
  - `updated_at`: string

#### DELETE: /api/tasks/{id}
- **Input**: Нет
- **Output**: Нет (статус 204)
