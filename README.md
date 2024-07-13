## Introduction - Management System

This is an imaginary managenent system crafted to fullfil the needs of project managers; and with that in mind, the main purpose of the project is to include as many Laravel features possible.

As a user, you will be able to manage users, projects as tasks.
All features to be addressed appropriately depending on the user role.

The frontend was integrated leveraging tailwindcss.

## Topics covered

Thus far, the topics covered are listed below.

  - Laravel Breeze and Authentication.
  - Authorization to ensure that certain operations are performed by the correct users.
  - Routing and controllers: Integrated various web routes fro creating, reading, updating, and deleting resources.
  - Views: Shared data to all view.
  - Blade: created reusable components.
  - Session
  - Validation
  - Eloquent (managing model data, relationships, and factories)
  - Database, migrations, seeding
  - Unit tests - Added one test

Some topics took more emphasis over others due to the tasks that had to be address. Nonetheless, surely other topics will be covered in more depth.

## USAGE

 - clone the repository
 - cd /directory/path (open three prompts)
 - prompt 1: composer install && npm install && npm run dev
 - prompt 2: php artisan serve

Prompt 3 is where you will run all other commands related to the project.

 - php artisan key:gen
 - .env: configure your desired default password for DEFAULT_PASSWORD. Note that you need to create this key as it does not yet exist.
 This will be the password used for your fake admin account.
 - php artisan migrate --seed

Note: the password for non admin users is: "password"


#### Get the gist and contribute with   ####