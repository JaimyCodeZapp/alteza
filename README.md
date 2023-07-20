## Setup

After cloning the repo follow these steps to setup the application locally. The application will be accessible on http://alteza.test and the admin dashboard on http://alteza.test/admin.

### Prerequisites

-   Composer
-   Docker
-   Docker Compose

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

Once the data has been seeded 3 users will have been created with different roles and permissions. The credentials for these test users can be found in the `UserSeeder`
