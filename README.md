# Dev-Blog

Fully functional blog site created in Laravel 7.

## Installation

```bash
# Installing Dependencies
composer install
npm install

# Create a database and edit the ".env" file as your desired

# Create symbolic link configured for the application
php artisan storage:link

# Running Migrations
php artisan migrate

# Importing Datas From Seeder
php artisan db:seed

# If APP_KEY is empty, you have to generate an encryption key
php artisan key:generate
```