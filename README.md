<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


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










