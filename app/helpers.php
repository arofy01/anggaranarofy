<?php

if (!function_exists('greeting')) {
    function greeting() {
        $hour = date('H');
        
        if ($hour >= 5 && $hour < 12) {
            return 'Pagi';
        } elseif ($hour >= 12 && $hour < 15) {
            return 'Siang';
        } elseif ($hour >= 15 && $hour < 18) {
            return 'Sore';
        } else {
            return 'Malam';
        }
    }
}
