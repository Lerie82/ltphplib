<?php
// autoload the classes in objects
spl_autoload_register(function ($class_name) {
    include 'obj/'.$class_name.'.php';
});

?>