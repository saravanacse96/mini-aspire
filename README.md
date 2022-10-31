# Getting started

## Installation
Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x)

## Clone the repository

````
git clone git@github.com
````

## Switch to the repo folder

````
 cd mini-aspire
````

## Install all the dependencies using composer

````
 composer install (or) composer update
````

Copy the example env file and make the required configuration changes in the .env file

````
 cp .env.example .env
````

Run the database migrations (<b>Set the database connection in .env before migrating</b>)

````
 php artisan migrate
````

Start the local development server

````
 php artisan serve
````

You can now access the server at http://localhost:8000

## Database seeding (optional)
   For users data generation with seed data. This can help you to quickly start testing (or) Use the API's
   
````
 php artisan db:seed
````

<b>Note </b> : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

````
 php artisan migrate:refresh
````


# API Specification

This application adheres to the api specifications. This helps mix and match any backend with any other frontend without conflicts.

## Testing API

Run the laravel development server

````
php artisan serve
````

The api can now be accessed at

````
http://localhost:8000/api
````


## Authentication
This applications uses OAuth2 API tokens to handle authentication. The token is passed with each request using the Authorization header with Token scheme. The Laravel Sanctum authentication middleware handles the validation and authentication of the token. 

# Code overview

## Folders structure
    app/Models - Contains all the Eloquent models
    app/Http/Controllers/Api - Contains all the api controllers
    app/Http/Middleware - Contains the (auth,IsAdmin,IsCustomer) middleware
    app/Http/Traits - Contains the api responses
    config - Contains all the application configuration files
    database/factories - Contains the model factory for all the models
    database/migrations - Contains all the database migrations
    database/seeds - Contains the database seeder
    routes - Contains all the api routes defined in api.php file
    tests - Contains all the application tests
    tests/Unit/Api - Contains all the api unit tests
    tests/Feature/Api - Contains all the api features tests










