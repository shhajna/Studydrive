# studydrive

## Installation

1. First run `composer update` to install the php packages.

2. Copy `.env.example` into `.env` and add your db credentials.

3. Run `php artisan migrate` to create the db tables.

4. Run `php artisan db:seed` to seed the database tables.

### Getting passport Client Id and Secret

1. Run `php artisan passport:install`

2. Copy the client id's and secrets to the .env file

3. Save the client_id=2 and the secret to the postman variables.

## Running laravel

1. Run `php artisan serve`


## Testing

1. Run `./vendor/bin/phpunit` to run the tests
