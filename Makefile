install:
    cp .env.example .env
    composer install
    php artisan key:generate
lint:
	composer run-script phpcs -- --standard=PSR2  app routes tests