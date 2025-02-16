# Tech Blog

This repository contains a Laravel-based blog application. 

## IMPORTANT TO READ ⚠️

The repository includes all necessary assets, including images, migrate files, and seeds. Making it easy to set up and run the application locally.

## Requirements
- PHP (>=8.0)
- Composer
- MySQL or any supported database
- Laravel 10 or later

## Installation Guide

Follow these steps to set up the application:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/resakastepme/techblog.git
   cd techblog
   ```

2. **Install dependencies:**
   ```bash
   composer update
   ```

3. **Copy environment file and configure database:**
   ```bash
   cp .env.example .env
   ```
   Edit the `.env` file and set up your database connection:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

5. **Run database migrations:**
   ```bash
   php artisan migrate
   ```

6. **Seed the database with sample data:**
   ```bash
   php artisan db:seed
   ```

7. **Start the development server:**
   ```bash
   php artisan serve
   ```

8. **Access the application:**
   Open your browser and visit:
   ```
   http://127.0.0.1:8000
   ```

## Additional Notes
- All required assets, including images, are already included in this repository.
- If you encounter any issues, ensure that your `.env` file is properly configured and the database is correctly set up.
- You may also need to set proper permissions for the `storage` and `bootstrap/cache` directories:
  ```bash
  chmod -R 777 storage bootstrap/cache
  ```

## License
This project is open-source and available under the [MIT License](LICENSE).
