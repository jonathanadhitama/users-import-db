# Installed packages:
- illuminate/database: Eloquent ORM for connecting, creating table, inserting, and updating user data in PostgreSQL.
- rap2hpoutre/fast-excel: Package for parsing CSV file.
- phpunit/phpunit: PHPUnit for unit testing.

# Setup Instructions:
- Navigate to project directory.
- Install packages: `composer install`
- Running unit tests: `./vendor/bin/phpunit`

# Running the script:
- `php user_upload.php --help`
- `php user_upload.php --create_table -u [username] -p [password] -h [host]`
- `php user_upload.php --file [file] --dry_run`
- `php user_upload.php --file [file] -u [username] -p [password] -h [host]`

# Command Directives:
- --help: Prints all possible command directives of this script
- --create_table: Creates a new users table. If there is an existing table, it will drop existing table before creating a new users table.
    - Requires -u, -p -h command directive.
- --dry_run: Process all user data from the provided CSV file. But will execute any database operations.
    - Requires --file command directive.
- --file: Provides the CSV file path to be processed.
    - Requires -u, -p -h command directive.

# Assumptions:
- The script assumes that the database server name is "users". To change this, navigate to `<project_dir>/services/validate_and_execute_command.php` and change line number 23.
- If "users" table already exists inside the database, --create_table directive will drop the existing table before creating a new "users" table.
- If there is a --dry_run command directive, command directives -u, -p, and -h is not required.
- If an email address already exists inside the table, then the script will update the name and the surname of the user.
- First row of the CSV file is considered the header and will not be processed by the script.
- If there is three or more column in the CSV file, the script will only consider the first three columns:
    - The first column as the name of the user.
    - The second column as the surname of the user.
    - The third column as the email address of the user.
- All whitespace characters (spaces and tabs) will be removed from the name and surname of the user prior to processing inside database.
- If a name or surname contains multiple words (i.e. surname van Gogh), each word in the name will be capitalised (i.e. Van Gogh).
- Any surname that starts with an O' or Mc the next corresponding character will be capitalised (i.e. O'Reilly and McDonalds). 
- Developed with PHP v7.4.10 and PostgreSQL version 12.4.