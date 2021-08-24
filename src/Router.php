<?php

namespace App;

class Router
{
    public function run(): void
    {
        $type = ucfirst(strtolower($_GET["type"] ?? "Main"));
        $action = "action" . ($_GET["action"] ?? "index");
        $controllerName = "App\\Controller\\$type";
        $userGroup = $_SESSION['user']['code'] ?? 'guest';
        $userGroups = include(__DIR__ . "/../usergroups.php");
        $allowedControllers = $userGroups[$userGroup];

        if (in_array($type, $allowedControllers)) {
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $action)) {
                    $controller->{$action}();
                    $controller?->view?->view();
                } else {
//                echo "Метод не найден";
                    header('HTTP/1.0 403 Forbidden');
                    include __DIR__ . "/../templates/errors/403.php";
                }
            } else {
//            echo "Класс не найден";
                header("HTTP/1.0 404 Not Found");
                include __DIR__ . "/../templates/errors/404.php";
            }
        } else {
            header('HTTP/1.0 403 Forbidden');
            include __DIR__ . "/../templates/errors/access_denied.php";
        }
    }
}