## Setup

After cloning the repo you have to follow the following steps to setup the application locally

#### Install composer dependencies

```
composer install
```

#### Setup .env

Copy `.env.example` to `.env` and setup your local env, the default sail database passwords are added in the `.env.example`.

To be able to test the emails you can quickly setup email catching with mailtrap.io

```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
```

#### Start sail

```
./vendor/bin/sail up
```

#### Link storage

```
./vendor/bin/sail php artisan storage:link
```

#### Install node_module

```
./vendor/bin/sail npm install
```

#### Run dev

```
./vendor/bin/sail npm run dev
```

### Migrate and seed database

```
./vendor/bin/sail php artisan migrate:fresh --seed
```
