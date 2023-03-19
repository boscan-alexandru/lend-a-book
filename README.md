![lend a book - repo cover image](https://github.com/boscan-alexandru/lend-a-book/blob/main/lend-a-book.png?raw=true)

# Lend a book - test

## Installation backend (api folder)

1. Clone the repo and `cd` into it
1. `composer install`
1. Rename or copy `.env.example` file to `.env`
1. Set your database credentials in your `.env` file
1. NOTE: this particular project uses an SQLite database located in `api/database/database.sqlite`
1. run `php artisan migrate:fresh --seed` to create the database table and seeds for them
1. `php artisan serve`

## Installation frontend (client folder)

1. `npm install`
1. `npm run dev`
1. Visit `localhost:3000` in your browser

## Design

for the design in Adobe Xd visit [https://xd.adobe.com/view/e5fceb69-5fd7-4dab-9287-dd9a65b93a8d-b0af/](https://xd.adobe.com/view/e5fceb69-5fd7-4dab-9287-dd9a65b93a8d-b0af/)
