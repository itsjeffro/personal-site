# Personal site

<p align="center">
<a href="https://github.com/itsjeffro/personal-site/actions"><img src="https://github.com/itsjeffro/personal-site/workflows/tests/badge.svg" alt="Build Status"></a>

Required PHP extensions:

- php-gmp

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

### JWT setup

```bash
openssl genrsa -out id_rsa.pem 2048
```

```bash
openssl rsa -in id_rsa.pem -outform PEM -pubout -out id_rsa.pub
```

### Assets

Install the required dependencies with `npm run install`. After, you may compile the files under `/resources` using the following command below.

```
npm run prod
```

## Tests

To run unit tests.

```bash
$ ./vendor/bin/phpunit
```

To generate code coverage.

```bash
$ ./vendor/bin/phpunit --coverage-html ./coverage
```