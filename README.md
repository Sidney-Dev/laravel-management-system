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

Open your command line(prompt) and tun the following commands from the directory where your projects reside

 - clone the repository (ie: git clone git@github.com:Sidney-Dev/laravel-management-system.git)
 - cd /directory/path (ie: cd laravel-management-system)

At this point you will need need 3 prompts opened and run the necessary commands and get the application started.

 - prompt 1: <code>composer install && npm install && npm run dev</code>
 - prompt 2: <code>php artisan serve</code>

Prompt 3 is where you will run all other commands related to the project.

 - <code>php artisan key:gen</code>
 - .env: configure your desired default password for DEFAULT_PASSWORD. Note that you need to create this key as it does not yet exist.
 This will be the password used for your fake admin account.
 - <code>php artisan migrate --seed</code>

Note: the password for non admin users is: "password"


#### I hope you get the gist  ####