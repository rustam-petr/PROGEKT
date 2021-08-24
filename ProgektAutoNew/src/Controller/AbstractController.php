<?php

namespace App\Controller;

use App\View\View;

abstract class AbstractController
{
    public View $view;

    public function __construct()
    {
        $this->view = new View();
        $this->view->setData(['controllerName' => $this->getCurrentClass()]);
    }

    public function redirect(string $url): void
    {
        header("Location: $url");
        exit();
    }

    public function getCurrentClass(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}