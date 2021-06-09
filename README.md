## Matrix Multiplication

Create a Laravel application for Matrix multiplication. The app should feature a REST API with authentication. For Matrix multiplication, the column count in the first matrix should be equal to the row count of the second matrix. If this condition is not met, the app should throw a validation error. The resulting matrix should contain characters rather than numbers, similar to excel columns. Examples: 1 => A, 26 => Z, 27 => AA, 28 => AB, etc.

Expectation

- At least PHP 7.4 or 8.0 for coding (8.0 recommended).
- PSR-2 coding standard.
- Strict type hinting.
- Tests.

## How to run the application

Below are the steps you need to successfully setup and run the application.

- **Clone the app from the repository and cd into the root directory of the app**
- **Run `composer install`**
- **Copy .env.example into .env**
- **Update DB credentials to match with your db**
- **Run `php artisan migrate` to migrate database tables**
- **Run `php artisan db:seed` to seed the default user record**
- **Run `php artisan jwt:secret` to generate the key**

## API Endpoints

The api endpoint collection is extracted by importing this link [Postman Collection](https://www.getpostman.com/collections/8414371914ee644dded6) on your postman.

## Running Test

The test is setup to use the refresh database trait, please ensure you create a db for running the test and updating it on the .env. To run the test
simply run `/vendor/bin/phpunit`

## Login Access

The default login access are `email : test@test.com` and `password : password`

**Enjoy!!!**
