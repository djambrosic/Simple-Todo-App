<?php

spl_autoload_register(function ($class) {
        include 'app/' . $class . '.php';
});
require 'app/config/config.php';

$app = new App();
