<?php
session_start();

include "../vendor/autoload.php";

(new App\Router())->run();