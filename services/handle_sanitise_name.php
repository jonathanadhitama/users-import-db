<?php
require_once "remove_whitespace_characters.php";
require_once "handle_capitalise_surname.php";
/**
 * Function to sanitise user name and surname
 * @param string $name
 * @param bool $is_surname
 * @return string
 */
function handle_sanitise_name($name, $is_surname) {
    $array_names = array_map(function ($item_name) use ($is_surname) {
        //Remove whitespace character from every item inside exploded name array
        if ($is_surname) {
            return remove_whitespace_characters(handle_capitalise_surname($item_name));
        } else {
            return remove_whitespace_characters(ucfirst(strtolower($item_name)));
        }
    }, explode(" ", trim($name)));
    return implode(" ", array_filter($array_names, function ($item_name) {
        //Combine all entries from exploded name array if string length is greater than zero
        return strlen($item_name) > 0;
    }));
}