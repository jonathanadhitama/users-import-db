<?php
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Create a new User Table. If table exists, it will drop current table before creating a new one.
 * @return void
 */
function create_user_table() {
    if (Capsule::schema()->hasTable("users")) {
        //If table exists, drop current table
        Capsule::schema()->drop("users");
    }

    Capsule::schema()->create('users', function ($table) {
        $table->string("name");
        $table->string("surname");
        $table->string("email")->unique();
    });
}
