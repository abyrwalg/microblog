<?php

require __DIR__ . "/App/autoload.php";

$ctrl = new App\Controllers\Index();
$ctrl->display();