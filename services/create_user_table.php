<?php
use Illuminate\Database\Capsule\Manager as Capsule;

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
