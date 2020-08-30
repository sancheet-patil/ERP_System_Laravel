<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>


## Installation guide

Follow below step by step installation guide.

- composer update
- cp .env.example .env
- php artisan config:cache
- php artisan key:generate
- php artisan storage:link
- php artisan migrate:fresh
- php artisan db:seed
- php artisan config:cache
