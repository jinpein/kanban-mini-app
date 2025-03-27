# Kanban Mini App

## Description
This is a Laravel-based Kanban application with a Vue.js frontend. It allows users to manage tasks across multiple columns, assign users to tasks, and track task history.

## Installation

### Backend Setup
1. Clone the repository:
   ```bash
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```bash
   cd kanban-mini-app
   ```
3. Install PHP dependencies:
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
6. Run database migrations:
   ```bash
   php artisan migrate
   ```

### Frontend Setup
1. Install Node.js dependencies:
   ```bash
   npm install
   ```
2. Build the frontend assets for development:
   ```bash
   npm run dev
   ```
   For production, use:
   ```bash
   npm run build
   ```

## Running the Application
1. Start the Laravel backend server:
   ```bash
   php artisan serve
   ```
2. Access the application at `http://localhost:8000`.

## Features
- Drag-and-drop task management across columns.
- Assign users to tasks.
- Track task history.
- Responsive design with Tailwind CSS.

## Development
- Backend: Laravel
- Frontend: Vue.js
- Styling: Tailwind CSS
