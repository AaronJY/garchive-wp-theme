<?php

class FormHelper
{
    public static function post_val($key, $default = '') {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }

        return $default;
    }
}