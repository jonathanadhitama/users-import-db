<?php
require "vendor/autoload.php";
use Illuminate\Database\Capsule\Manager as Capsule;

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

function validate_and_execute($argv)
{
    if (in_array("--create_table", $argv)) {
        return "Creating User Table";
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
    }
}