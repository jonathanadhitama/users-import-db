<?php

/**
 * Function that validates whether the username, password, and host service directives are provided
 * @param array $argv
 * @return array
 */
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
    return ["valid" => $valid, "message" => $error_message];
}