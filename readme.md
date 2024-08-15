# How to run?

## Load all files

```bash
composer install
```

## Migrate the Database

```bash
php migrate.php
```

## Seed the Database (If necessary)

```bash
php seed.php
```

## Run the Project

```bash
php -S localhost:8000 public/index.php
```

# Seed User Information
```txt
hridoy@test.com (admin)
jhon@doe.com
jane@doe.com
jefry@way.com
nirob@example.com

All password: 12345678
```

# How to create admin?

To create admin:

1. First Register as a Customer from website

2. Run Following command and provide Email Address :

```bash
php admin.php
```
