<?php
/**
 * check the current route
 *
 * @return String
*/

use GuzzleHttp\Psr7\Request;

if(!function_exists('class_active')) {
    function class_active($route) {
        return request()->is($route . '/*') || request()->is($route) ? 'active' : '';
    }
}