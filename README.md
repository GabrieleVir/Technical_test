# PHP test

## 1. Installation

  - Install the last version of composer if you don't have it.
  - Go on the root of the project and use the command ```composer install``` then ```composer update```
  - Create a database-config.php inside the config folder using the database-config-template.php as reference.
  - Create a database with the same name as the one you chose for database-config.php on 'dbname'
  - On the root of the project use ```vendor/bin/doctrine orm:schema-tool:update --force```
  - Import the demo/demo_data.sql inside your database.
  - Use ``` php index.php ``` to run the demo script.

 ## 2. Libraries used

   - Composer for a package manager
   - Doctrine for an ORM.