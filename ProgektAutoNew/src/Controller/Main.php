<?php


namespace App\Controller;


use App\View\View;

class Main extends AbstractController
{
    public function actionIndex(): void
    {
        $this
            ->view
            ->setTemplate("Main/index");
    }
}