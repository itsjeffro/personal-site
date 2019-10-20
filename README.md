# Personal site

## Getting started

### Installation

To get started, run the following command below.

```
composer install
```

If the `.env` file is not created you may create a copy and set your `APP_KEY`.

```
cp .env.example .env
```

```
php artisan key:gen
```

Before running the project migrations, ensure that you have set you database credentials. Then you may run the following command.

```
php artisan migrate --seed
```

### Assets

Install the required dependencies with `npm run install`. After, you may compile the files under `/resources` using the following command below.

```
npm run prod
```