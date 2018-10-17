install:
    composer install
    cp .env.example .env
    php artisan key:generate

lint:
	composer run-script phpcs -- --standard=PSR2  app routes tests

test:
	composer run-script phpunit