## Installation

Clone the repository

    https://github.com/iambasanta/asky.git

Switch to the repo folder

    cd asky

Install all the dependencies using composer

    composer install

Install npm dependencies

    npm install

Copy the example `.env.example` in `.env` file

    cp .env.example .env

Open and make the required configuration changes in the `.env` file

-   `DB_DATABASE`
-   `DB_USERNAME`
-   `DB_PASSWORD`

Generate a new application key

    php artisan key:generate

Run the database migrations (**Make sure you have proper database connection in `.env` before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000
