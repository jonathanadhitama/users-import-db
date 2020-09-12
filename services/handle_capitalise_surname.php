<?php

/**
 * Function to handle capitalising surname of the user
 * @param string $surname
 * @return string
 */
function handle_capitalise_surname($surname) {
    $custom_surnames = ["o'", "mc"];
    foreach ($custom_surnames as $custom_surname) {
        if (strtolower(substr($surname, 0, strlen($custom_surname))) === $custom_surname) {
            return ucfirst($custom_surname) . ucfirst(strtolower(substr($surname, strlen($custom_surname))));
        }
    }
    return ucfirst(strtolower($surname));
}