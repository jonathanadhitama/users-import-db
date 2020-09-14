<?php
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Create a new User Table. If table exists, it will drop current table before creating a new one.
 * @return string
 */
function create_user_table() {
    try {
        if (Capsule::schema()->hasTable("users")) {
            //If table exists, drop current table
            Capsule::schema()->drop("users");
        }

        Capsule::schema()->create('users', function ($table) {
            $table->string("name");
            $table->string("surname");
            $table->string("email")->unique();
        });
    } catch (PDOException $exception) {
        return "Fail to create users table: " . $exception->getMessage() . "\n";
    }
    return "Table users has been created!\n";
}
