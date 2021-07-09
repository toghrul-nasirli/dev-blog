# Dev-Blog

Fully functional blog site created in Laravel 7.

## Installation

```bash
# Installing Dependencies
composer install
npm install && npm run dev

# Create a mysql database and edit the ".env" file as you like

# Create symbolic link configured for the application
php artisan storage:link

# Generate an encryption key
php artisan key:generate

# Running Migrations and Seeds
php artisan migrate --seed
```
