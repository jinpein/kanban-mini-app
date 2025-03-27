# My Laravel Application

## Description
This is a Laravel application that serves as a skeleton for building web applications.

## Installation
1. Clone the repository:
   ```bash
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```bash
   cd kanban-mini-app
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Copy the `.env.example` to `.env` and configure your environment variables:
   ```bash
   cp .env.example .env
   ```
5. Generate the application key:
   ```bash
   php artisan key:generate
   ```
6. Run migrations:
   ```bash
   php artisan migrate
   ```
7. Start the application:
   ```bash
   php artisan serve
   ```

## Usage
Access the application at `http://localhost:8000`.
