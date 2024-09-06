<?php


if (!function_exists('post')) {
    function post(): bool
    {
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            return true;
        }   

        return false;
    }
}