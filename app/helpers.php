<?php

/**
 * Set active state if route matches.
 *
 * @param string $route Route name
 * @param string $class CSS class applied to active route
 */
function setActive($route, $class = 'active')
{
    return (Route::currentRouteName() == $route) ? $class : '';
}
/**
 * Converts an object to an array (nesting conversion).
 *
 * @param $object
 *
 * @return array
 */
function objectToArray($object)
{
    if (is_array($object) or is_object($object)) {
        $result = [];
        foreach ($object as $key => $value) {
            $result[$key] = objectToArray($value);
        }

        return $result;
    }

    return $object;
}

function serializeArray($array)
{
    $o = [];

    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $v = implode(',', $value);
            $o[$key] = $v;
        } else {
            $o[$key] = $value;
        }
    }

    return $o;
}

function humanFilesize($bytes, $decimals = 2)
{
    $size = ['B','kB','MB','GB','TB','PB','EB','ZB','YB'];
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)).@$size[$factor];
}

function formatNumberTwoDigits($number)
{
    return number_format($number, 1, ',', ' ');
}
