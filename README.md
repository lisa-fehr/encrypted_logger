# :memo: Encrypted Daily Logger
## Requirements
- PHP ^8.1
- Laravel ^10.10
- GD Library *

> [!IMPORTANT]
> Currently dependent on the `APP_KEY`. Keep a copy from your .env file after running `php artisan key:generate` or the data will not decrypt.

## About
Ideal for apps on shared servers. Encrypt the data and photos to prevent viewing outside the app in the file directory or database.

A mobile friendly tool to store observed events/concerns with descriptions, tags and photo reminders.
Add actions to see if it affects the concern. 

Highlight concern frequency and make it measurable.

## Getting started
Add the environment files
```bash
cp .env.example .env
```
```bash
cp .env.example .env.testing
```
Update the configuration on the testing env to be `APP_ENV=testing` and copy or generate a new `APP_KEY`

Add your database information to both files but use two different databases for local and testing.

### Setup

```bash 
php artisan key:generate
```
```bash
composer install
```
```bash
php artisan migrate
```


## Development
Add the demo user and dummy data:

```bash
php artisan db:seed
```
Should generate the credentials:

`admin@test.com` / `admin`
