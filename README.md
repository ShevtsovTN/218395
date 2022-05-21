<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Technical task

You need to create a project on Laravel (REST API), only Backend! The subject area for the data is up to you.

### Implementation features:

#### 1. The project contains a database of two tables with a many-to-many relationship;
#### 2. Working with the database should be done through the repository pattern;
#### 3. It is necessary to implement simple authentication through a key (without using the additional packages passport, jwt etc., you can generate your own in .env);
#### 4. The API should provide data access with the ability to sort and search across multiple fields;
#### 5. In the process of working with data, you must use the pivot attribute for models and include it in search queries.

## Launch of the project:

#### 1. Clone the project from github to your computer.

#### 2. Set up the project connection to the database in the .env file.

#### 3. Run migrations and seeders with `php artisan migrate:fresh --seed`.

#### 4. Import the collection of routes into Postman from the `api_routes_test` folder.
