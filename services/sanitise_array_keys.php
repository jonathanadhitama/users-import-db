<?php
require_once "remove_whitespace_characters.php";

/**
 * Function that remove all white space characters from the array keys and also makes all array keys lowercase
 * @param array $array
 * @return array
 */
function sanitise_array_keys($array) {
    $output = [];
    foreach ($array as $item) {
        $temp = [];
        foreach ($item as $key => $value) {
            $newKey = strtolower(remove_whitespace_characters($key));
            $temp[$newKey] = $value;
        }
        $output[] = $temp;
    }
    return $output;
}