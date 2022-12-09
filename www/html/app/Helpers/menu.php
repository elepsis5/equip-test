<?php

if (!function_exists('getQuantityOfProducts')) {
    function getQuantityOfProducts(array $group) {
        $quantity = 0;
        getCount($group, $quantity);
        return $quantity;
    }
}
if (!function_exists('getCount')) {
    function getCount($group, &$quantity) {
        if ($group['count']) {
            $quantity += $group['count'];
        }
        if (array_key_exists('child', $group)) {
            foreach ($group['child'] as $child) {
                getCount($child, $quantity);
            }
        }

    }
}