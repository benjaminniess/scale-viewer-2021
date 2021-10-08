# Scale viewer

# About

This project is just a sandbox so far. The long time goal of the project is to manage different scaled numbers on a
single board.

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

### Register a new User

#### Request

`POST /api/register`

    curl -X POST \
    http://localhost:8000/api/register \
    -H 'Accept: application/json' \
    -H 'content-type: multipart/form-data; \
    -F email=your@email.com \
    -F password=123456789 \
    -F password_confirmation=123456789 \
    -F name=Your Name

#### Response

    HTTP/1.1 201 Created
    Status: 201 Created
    Connection: close
    Content-Type: application/json

    ""

### Log a new user in

#### Request

`POST /api/login`

    curl -X POST \
    http://localhost:8000/api/login \
    -H 'Accept: application/json' \
    -H 'content-type: multipart/form-data \
    -F email=your@email.com \
    -F password=123456789 \
    -F 'device_name=My device name'

#### Response

    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close
    Content-Type: application/json

    "4|UT3G3GunUewODFluTXJbWpIGAXv4a0FhT315rsuW"

### See the logged user main data

#### Request

`GET /api/user`

    curl -X GET \
    http://localhost:8000/api/user \
    -H 'Accept: application/json' \
    -H 'Authorization: Bearer 4|UT3G3GunUewODFluTXJbWpIGAXv4a0FhT315rsuW' \

#### Response

    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close
    Content-Type: application/json

    {
        "id": 9,
        "name": "Your name",
        "email": "your@email.com",
        "email_verified_at": null,
        "two_factor_secret": null,
        "two_factor_recovery_codes": null,
        "created_at": "2021-10-08T19:43:08.000000Z",
        "updated_at": "2021-10-08T19:43:08.000000Z"
    }

### Log the user out

#### Request

`GET /api/logout`

    curl -X GET \
    http://localhost:8000/api/logout \
    -H 'Accept: application/json' \
    -H 'Authorization: Bearer 4|UT3G3GunUewODFluTXJbWpIGAXv4a0FhT315rsuW' \

#### Response

    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close
    Content-Type: application/json

    "logged-out"

## Tests

Run

`php artisan test` (or `sail artisan test` if using sail)
