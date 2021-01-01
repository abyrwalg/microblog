<?php

require __DIR__ . "/App/autoload.php";

$ctrl = new App\Controllers\Login();
$ctrl->display();