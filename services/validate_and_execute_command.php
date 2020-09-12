<?php
require_once "validate_username_password_host.php";
require_once "create_user_table.php";
require_once "get_argument_value.php";
require_once "insert_or_update_users.php";
require "vendor/autoload.php";
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Function that connects to the PostgreSQL Database
 * @param string $host database host
 * @param string $username database username
 * @param string $password database password
 * @return void
 */
function db_connect($host, $username, $password)
{
    $capsule = new Capsule;
    $capsule->addConnection([
        "driver" => "pgsql",
        "host" => $host,
        "port" => "5432",
        "database" => "users",
        "username" => $username,
        "password" => $password
    ]);

    //Make this Capsule instance available globally.
    $capsule->setAsGlobal();

    // Setup the Eloquent ORM.
    $capsule->bootEloquent();
}

/**
 * Functions that validates the directive as given in the argv before executing
 * @param array $argv argv array
 * @return string
 */
function validate_and_execute($argv)
{
    if (in_array("--create_table", $argv)) {
        $validation = validate_username_password_host($argv);
        if (!$validation["valid"]) {
            return $validation["message"];
        }
        db_connect(get_argument_value("-h", $argv), get_argument_value("-u", $argv), get_argument_value("-p", $argv));
        create_user_table();
    } elseif (in_array("--help", $argv)) {
        return "
            --file [csv file name] – this is the name of the CSV to be parsed
            --create_table – this will cause the PostgreSQL users table to be built (and no further action will be taken)
            --dry_run – this will be used with the --file directive in case we want to run the script but not insert into the DB. All other functions will be executed, but the database won't be altered
            -u – PostgreSQL username
            -p – PostgreSQL password
            -h – PostgreSQL host
            --help – which will output the above list of directives with details.
        ";
    } else {
        if (!in_array("--file", $argv) && !in_array("--dry_run", $argv)) {
            return "Invalid command option. Please run --help command to see all possible commands options";
        }
        if (!in_array("--file", $argv)) {
            return "Please provide the --file command option specifying the csv file to process users.";
        }
        $insert_to_db = !in_array("--dry_run", $argv);
        $validation = validate_username_password_host($argv);
        if ($insert_to_db && !$validation["valid"]) {
            return $validation["message"];
        }
        if ($insert_to_db && $validation["valid"]) {
            db_connect(get_argument_value("-h", $argv), get_argument_value("-u", $argv), get_argument_value("-p", $argv));
        }
        return insert_or_update_users(get_argument_value("--file", $argv), $insert_to_db);
    }
}