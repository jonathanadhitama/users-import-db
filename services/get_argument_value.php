<?php

/**
 * Function that gets the value of a service directive key (i.e. -u test will return test)
 * @param string $key service directive key
 * @param array $argv argv array
 * @return string
 */
function get_argument_value($key, $argv) {
    if (in_array($key, $argv)) {
        $index = array_search($key, $argv);
        if ($index + 1 < count($argv)) {
            return $argv[$index + 1];
        }
    }
    return "";
}