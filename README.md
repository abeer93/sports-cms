# Task
    Simple laravel application for presenting matches and its seasons

## Requirement

```
  1. [Laravel 8.x](https://laravel.com/docs/7.x)
  2. [PHP >= 7.3] (http://php.net/downloads.php)
  3. [Composer](https://getcomposer.org/)
```

## Installation
1. Clone the repo via this url 
  ```
    git clone https://github.com/abeer93/sports-cms.git
  ```

2. Enter inside the folder
```
  cd sports-cms
```
3. Create a `.env` file by running the following command 
  ```
    cp .env.example .env
  ```
4. Edit DB variables in `.env` as following 
  ```
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=docker_app
    DB_USERNAME=root
    DB_PASSWORD=P@ssword2020
  ```
5. Build Docker 
  ```
    sudo chown -R $USER:$USER ./
    docker-compose up -d
  ```
6. Install various packages and dependencies: 
  ```
    docker-compose exec app composer install
  ```
7. Generate an encryption key for the app:
  ```
    docker-compose exec app php artisan key:generate
  ```
8. Run migartions
  ```
    docker-compose exec app php artisan migrate
  ```
9. Run npm
  ```
    npm install
    npm run dev
    npm run dev
  ```
10. If you need to run test cases
  ```
    docker-compose exec app php vendor/bin/phpunit
  ```

Now, open your web browser and got `http://localhost:8088` .

### Docs & Help

- [Laravel 7.x Documentation](https://laravel.com/docs/8.x)