<?php
function filter_by_key($array, $allowed_values, $key, $unique_key)
{
      $unique_ages = [];
    $filtered_array = array_filter($array, function($item) use ($allowed_values, &$unique_ages, $unique_key, $key) {
        if(isset($item[$key]) && in_array($item[$key], $allowed_values) && !in_array($item[$unique_key], $unique_ages)) {
            $unique_ages[] = $item[$unique_key];
            return true;
        }
        return false;
    });
    usort($filtered_array, function($a, $b) {
        return $b['id'] - $a['id'];
    });
    return $filtered_array;
}
