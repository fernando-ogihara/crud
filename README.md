# CakePHP Application Skeleton

![Build Status](https://github.com/cakephp/app/actions/workflows/ci.yml/badge.svg?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%207-brightgreen.svg?style=flat-square)](https://github.com/phpstan/phpstan)

A skeleton for creating applications with [CakePHP](https://cakephp.org) 5.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

## Update

Since this skeleton is a starting point for your application and various files
would have been modified as per your needs, there isn't a way to provide
automated upgrades, so you have to do any updates manually.

## Configuration

Read and edit the environment specific `config/app_local.php` and set up the
`'Datasources'` and any other configuration relevant for your application.
Other environment agnostic settings can be changed in `config/app.php`.

## Layout

The app skeleton uses [Milligram](https://milligram.io/) (v1.3) minimalist CSS
framework by default. You can, however, replace it with any other library or
custom styles.

## MAILTRAP

For testing purposes, I configured Mailtrap. You can create a free account here: https://mailtrap.io/.

After creating a free account, go to the dashboard, then click on Email Testing -> Inboxes.

Next, click on the free inbox, and in the Integration tab, you will find the Username and Password. These values should be added to your .env.local file.

## DATABASE

To set up the database, you can either:

### Option 1: Import the SQL file

1. In the `Database` folder, locate the `albums.sql` file.
2. Import the SQL file into your MySQL database using a tool like phpMyAdmin, MySQL Workbench, or via the command line.

### Option 2: Run the SQL query directly

If you prefer to run the SQL commands manually, execute the following queries in your MySQL client:

```sql
CREATE DATABASE albums_db;

USE albums_db;

CREATE TABLE `albums` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `artist_name` VARCHAR(255) NOT NULL,
  `album_name` VARCHAR(255) NOT NULL,
  `album_year` INT(11) NOT NULL,
  `published` TINYINT(1) DEFAULT 0,
  `created` DATETIME DEFAULT CURRENT_TIMESTAMP(),
  `modified` DATETIME DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

```

## APPLICATION

** add the .env.local file to the config folder **

- Run the application with:
  ```bash
  bin/cake server

Access the application at: http://localhost:8765/

    If necessary, clear the cache by running:

    bin/cake cache clear_all

Features

    The application runs on a single page:
        If albums exist in the database, they will be displayed.
        If no albums are available, the user can add new albums by clicking the PLUS button.

    Adding an Album:
        The user must select an artist, enter an album name, and select the year.
        The Add button is only enabled if all fields are populated. If any field is empty, the button will be disabled with the text "not allowed".

    Notifications:
        After adding, editing, or deleting an album, a success message will be displayed at the top of the page.
        The success message will automatically disappear after 1.5 seconds.
        **Additionally, an email notification will be sent to the registered email address with details about the action performed.
        (If a email service is set - for now in the controller this action is commented out)

    Deleting an Album:
        A confirmation modal will be shown to ensure the user intends to delete the album. If the deletion was accidental, the user can cancel the action.

## PHP TESTS (an example)

To run PHP tests, navigate to the app folder and run:

./vendor/bin/phpunit

## JS TESTS (an example)

To run JavaScript tests using Jest:

    In the app folder, install Jest and jsdom:

    npm install --save-dev jest
    npm install --save-dev jest jsdom

Once installed, run the JavaScript tests with:

    npm test


