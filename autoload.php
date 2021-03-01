<?php

define('DS',DIRECTORY_SEPARATOR);

spl_autoload_register(function ($className) {

    $exploded = explode('\\',$className);

    $namespace = $exploded[0];
    if (count($exploded) === 1){
        $class = $exploded[0];
    } else {
        $class = $exploded[1];
    }

    if ($namespace === 'App'){
        require 'App' . DS . $class.'.php';
    } elseif($namespace === 'Config'){
        require 'Config' . DS . $class.'.php';
    } elseif($namespace === 'Controller'){
        require 'Controller' . DS . $class.'.php';
    } elseif($namespace === 'DB'){
        require 'DB' . DS . $class.'.php';
    } elseif ($namespace === 'Product' ){
        require 'Product' . DS . $class.'.php';
    } elseif ($namespace=== 'Payment' ){
        require 'Payment' . DS . $class.'.php';
    } else {
        require $class . '.php';
    }
});
