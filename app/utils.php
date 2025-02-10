<?php

if (!function_exists('generateRandomCode')) {
    function generateRandomCode($length) {
        // Define the character set: digits, uppercase, and lowercase letters
        $charSet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $randomCode = '';
        $charSetLength = strlen($charSet);

        // Generate the random code
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, $charSetLength - 1);
            $randomCode .= $charSet[$randomIndex];
        }

        return $randomCode;
    }
}
