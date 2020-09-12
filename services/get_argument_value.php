<?php

function get_argument_value($key, $argv) {
    if (in_array($key, $argv)) {
        $index = array_search($key, $argv);
        if ($index + 1 < count($argv)) {
            return $argv[$index + 1];
        }
    }
    return "";
}