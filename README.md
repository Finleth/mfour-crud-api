# MFour CRUD API

An API built to demonstrate Jeffrey Pau's abilities to write a functioning CRUD API using PHP Laravel.
## Getting Started

To set up a local version of this project, you will first need to fork the repository and download it to your local machine (Note, these instructions assume MySQL has been installed and a database has been created for the project. I used the MAMP MySQL database for my local development).

After you have done this, from the command line, `cd` into the project's repository and run `composer install`.

Next, set up the `.env` file. Take the `.env.example` file and make a duplicate, renaming the duplicate to `.env`. Within the `.env` file, set the DB_* variables to the appropriate host, database, user, password, and port (if necessary).
You can also update the API_KEY to any value of your choosing. I left my value in the example file to make the setup faster.

Run the following command to generate the laravel application key:

```
php artisan key:generate
```

Now that you have the dependencies installed and the environment configurations set up, go to your database and run the  `structure.sql` file to get the database set up.

At this point you can go to your terminal, in the project's root directory, and run the following command:

```
php artisan serve
```

This will run the laravel helper `artisan` and spin up a server on localhost:8000 to test this API.

## Basic Usage

You can run the following curl commands to check each endpoint and ensure it's working properly:

GET /users
```
curl -X GET \
  http://localhost:8000/api/users \
  -H 'Authorization: Bearer <API_KEY from .env>' \
  -H 'Content-Type: application/json' \
```

POST /users/create
```
curl -X POST \
  http://localhost:8000/api/users/create \
  -H 'Authorization: Bearer <API_KEY from .env>' \
  -H 'Content-Type: application/json' \
  -d '{
	"first_name": "John",
	"last_name": "Doe",
	"email": "johndoe@fake.com"
  }'
```

POST /users/update
```
curl -X POST \
  http://localhost:8000/api/users/update/<user_id> \
  -H 'Authorization: Bearer <API_KEY from .env>' \
  -H 'Content-Type: application/json' \
  -H 'cache-control: no-cache' \
  -d '{
    "first_name": "New",
    "last_name": "Name",
	"email": "new@email.com"
  }'
```

## Unit Testing

This project has a feature test set up to run through the /users endpoints. To run this test, `cd` to the project root directory and run the following command:

```
vendor/bin/phpunit
```

This will run the test found in `tests/feature/UsersTest.php`.

You should see an OK status on all 5 tests and 8 assertions.

## Notes

I'd like to mention this was my first time using Laravel and realize this application will have plenty of brute-force implementations. I've personally got a list of areas I'd like to expand on/update to help polish the application:

- Oauth2.0: Set up the oauth/token tables in the database and add the authentication endpoint with scopes
  - Set up without passport so I can get a better understanding of Laravel
- Add unit tests for the /users endpoints (UPDATE: have added very basic tests)
- Exception Handler: Add proper exception handling/JSON responses in the app\Exceptions\Handler.php class
- Expand the CRUD operations on the `user` resource