<?php

function validate_username_password_host($argv) {
    $valid = true;
    $error_message = "";
    if (!in_array("-u", $argv)) {
        $valid = false;
        $error_message .= "Please provide the -u command option to specify the database username to insert user into DB\n";
    }
    if(!in_array("-h", $argv)) {
        $valid = false;
        $error_message .= "Please provide the -h command option to specify the database username to insert user into DB\n";
    }
    if (!in_array("-p", $argv)) {
        $valid = false;
        $error_message .= "Please provide the -p command option to specify the database username to insert user into DB\n";
    }
    return ["valid" => $valid, "message" => substr($error_message, 0, -1)];
}