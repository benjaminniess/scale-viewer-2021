# Scale viewer

# About

This project is just a sandbox so far. The long time goal of the project is to manage different scaled numbers on a
single board.

# TODO

### Accounts

- Forgot password
- Update password
- Delete account

### Boards

- Update board
- Delete board
- Pagination

### Numbers

- Add numbers
- Update numbers
- Reorder numbers
- Delete numbers
- Add a "display value" to numbers

### Generic

- Cache
- Front end app
- Repositories

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

### Get the boards list

#### Request

`GET /api/boards`

    curl -X GET \
    http://localhost:8000/api/boards \
    -H 'Accept: application/json' \

#### Response

    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close
    Content-Type: application/json

    [
        {
            "id": 1,
            "title": "Quis laboriosam porro sapiente eum tenetur inventore qui.",
            "description": "Nihil eius nihil exercitationem sed repudiandae. Asperiores non eos excepturi autem velit. Quibusdam voluptatum necessitatibus sunt ex.",
            "user_id": 1,
            "created_at": "2021-10-13T13:00:16.000000Z",
            "updated_at": "2021-10-13T13:00:16.000000Z"
        },
        {
            "id": 2,
            "title": "Distinctio adipisci earum voluptates voluptatem est.",
            "description": "Praesentium maxime est temporibus debitis voluptatem. Ab in delectus eveniet voluptatem voluptatibus occaecati aliquid. Harum commodi harum voluptatem fugit provident alias quasi. Sunt quibusdam cum molestiae quasi.",
            "user_id": 1,
            "created_at": "2021-10-13T13:00:16.000000Z",
            "updated_at": "2021-10-13T13:00:16.000000Z"
        },
        { ... }
    ]

### Get a single board with related numbers

#### Request

`GET /api/boards/1`

    curl -X GET \
    http://localhost:8000/api/boards/1 \
    -H 'Accept: application/json' \

#### Response

    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close
    Content-Type: application/json

    {
        "id": 1,
        "title": "Est provident laudantium qui eum recusandae itaque.",
        "description": "Quidem nesciunt tempora sunt quod. Vero quae sit et modi sed iste laudantium. Aut corporis quo sit earum velit velit corrupti. Corporis saepe natus velit. Molestiae blanditiis autem reprehenderit quas culpa rerum saepe.",
        "user_id": 1,
        "created_at": "2021-10-13T13:18:43.000000Z",
        "updated_at": "2021-10-13T13:18:43.000000Z",
        "numbers": [
            {
                "id": 1,
                "value": 64287,
                "description": "Quisquam minus delectus explicabo. Nam facilis commodi voluptas nostrum qui id voluptatem voluptas. Est modi corrupti omnis autem. Qui perferendis omnis perferendis distinctio perferendis labore.",
                "board_id": 1,
                "created_at": "2021-10-13T13:18:43.000000Z",
                "updated_at": "2021-10-13T13:18:43.000000Z"
            },
            {
                "id": 2,
                "value": 57438,
                "description": "Sint labore fugiat et omnis recusandae minima soluta. Id illum quibusdam nesciunt praesentium. Ipsam autem nisi porro et distinctio. Tempore harum sunt odio nemo. Itaque cum ea et quam qui et laborum.",
                "board_id": 1,
                "created_at": "2021-10-13T13:18:43.000000Z",
                "updated_at": "2021-10-13T13:18:43.000000Z"
            },
            {...}
        ]
    }

### Insert a new empty board

#### Request

`POST /api/boards`

    curl -X POST \
    http://localhost:8000/api/boards \
    -H 'Accept: application/json' \
    -H 'Authorization: Bearer 4|UT3G3GunUewODFluTXJbWpIGAXv4a0FhT315rsuW' \

#### Response

    HTTP/1.1 201 Created
    Status: 200 Created
    Connection: close
    Content-Type: application/json

    {
        "title": "My board title",
        "description": "My board description",
        "user_id": 17,
        "updated_at": "2021-10-14T06:25:16.000000Z",
        "created_at": "2021-10-14T06:25:16.000000Z",
        "id": 11
    }

### Add a number to a board

#### Request

`POST /api/boards/XXX/numbers`

    curl -X POST \
    http://localhost:8000/api/boards/1234 \
    -H 'Accept: application/json' \
    -H 'Authorization: Bearer 4|UT3G3GunUewODFluTXJbWpIGAXv4a0FhT315rsuW' \

#### Response

    HTTP/1.1 201 Created
    Status: 200 Created
    Connection: close
    Content-Type: application/json

    {
        "title": "My board title",
        "description": "My board description",
        "user_id": 17,
        "updated_at": "2021-10-14T06:25:16.000000Z",
        "created_at": "2021-10-14T06:25:16.000000Z",
        "id": 11
        "numbers": [
            {
                "id": 12,
                "value": 1234,
                "description": "number of tests",
                "board_id": 11,
                "created_at": "2021-10-14T06:26:28.000000Z",
                "updated_at": "2021-10-14T06:26:28.000000Z"
            }
        ]
    }

## Tests

Run

`php artisan test` (or `sail artisan test` if using sail)
