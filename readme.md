# My Improvement comparing to the previous repository

- Separate routes form index.php to `routes/web.php`
- Provide `.env.example` as a configuration file.
- 2 types of database (mysql or file) implemented.
- make custom command `bangu` like `artisan` in laravel
- available commands

```bash
php bangu serve
php bangu createAdmin
php bangu migrate
php bangu seed
php bangu -h
```

# How to run?

## Load all files

```bash
composer install
```

## Configure the Project

```bash
cp .env.example .env
```

If `cp` command is not available then manually copy `.env.example` to `.env`

Configure `.env` file. `mysql` is default database. You can also choose `file` as database.

For `file`, just use following configuration

```bash
DB_TYPE = file
```

For `mysql`, your configuration looks like this. Please modify according to your setup

```bash
DB_TYPE = mysql
DB_HOST = 127.0.0.1
DB_PORT = 3306
DB_USER = root
DB_PASSWORD =
DB_NAME = bangu
DB_CHARSET = utf8mb4
```

## Create the Database

For `mysql`, You need to create a database using `phpmyadmin` or `tableplus` or something like that.

## Migrate the Database

```bash
php bangu migrate
```

## Seed the Database (If necessary)

```bash
php bangu seed
```

## Run the Project

```bash
php bangu serve
```

By default it will be served `8080` port. If it has already been used, this command `automatically served` by next available port

# Seed User Information

```txt
hridoy@test.com (admin)
jhon@doe.com
jane@doe.com
jefry@way.com
nirob@example.com

Password of all users: 12345678
```

# How to create admin?

To create admin:

1. First Register as a Customer from website

2. Run Following command and provide Email Address :

```bash
php bangu createAdmin
```

# How to show available commands?

```bash
php bangu -h
```
