<?php

/**
 * Functions that remove all whitespace characters (spaces and tabs) from a string
 * @param string $string
 * @return string
 */
function remove_whitespace_characters($string) {
    return trim(preg_replace('/\s+/', '', $string));
}