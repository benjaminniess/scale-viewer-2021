# Scale viewer

# About

This project is just a sandbox so far. The long time goal of the project is to manage different scaled numbers on a single board.

## Installation

Install dependencies

`composer install`

Copy the `.env.example` file and make the necessary changes that fit your database needs 

`cp .env.example .env`

Run the migration command optionally with the `--seed` param

`php artisan migrate:fresh --seed`

## Start

`php artisan serve`

(or `sail up` if you are using sail)

## API routes 

### Register 

POST `/api/register`

Required params :
- email
- name
- password
- password_confirmation

POST `/api/login`

Required params :
- email
- password
- device_name

That's it so far... Stay tuned!

## Tests

Run 

`php artisan test` (or `sail artisan test` if using sail)
