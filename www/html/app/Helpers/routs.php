<?php
function myRoute($param = null) {
    $current = Route::current();
    if ($param) {
        try {
            if (array_key_exists($param, $current->parameters)) {
                return $current->parameters[$param];
            }
        }
        catch (Exception $e) {
            dump('Invalid parameter:' . $e);
        }
    }
    return 0;
};