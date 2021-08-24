<?php

namespace App\Controller;

use W1020\Table as ORMTable;
use App\View\View;

/**
 * Class Table
 * @package App\Controller
 */
abstract class Table extends AbstractController
{
    /**
     * @var ORMTable
     */
    protected ORMTable $model;
    /**
     * @var string
     */
    protected string $tableName = "";
    /**
     * @var int
     */
    protected int $pageSize = 10;

    public function __construct()
    {
        parent::__construct();
        $config = include __DIR__ . "/../../config.php";
        $config["table"] = $this->tableName;
        $this->pageSize = $config["page_size"];
        $this->model = new ORMTable($config);
    }

    /**
     * Показывает таблицу
     * @throws \Exception
     */
    public function actionShow(): void
    {
        $page = $_GET["page"] ?? 1;
        $headers = [];
        $headers["id"] = "№";

        foreach ($this->model->columnComments() as $key => $value) {
            $headers[$key] = $value;
        }

        $headers["del"] = "Удалить";
        $headers["edit"] = "Редактировать";

        $this
            ->view
            ->addData([
                "table" => $this->model->setPageSize($this->pageSize)->getPage($page),
                "comments" => $headers,
                "activePage" => $page,
                "pageCount" => $this->model->pageCount()
            ])
            ->setTemplate("Table/show");
    }

    /**
     * Удаляет строку из таблицы
     */
    public function actionDel(): void
    {
        $this->model->del($_GET["id"]);
        $this->redirect("?type={$this->getCurrentClass()}&action=show");
    }

    /**
     * Показывает страницу для добавления новой строки
     */
    public function actionShowAdd(): void
    {

        $this
            ->view
            ->addData([
                "comments" => $this->model->columnComments(),
                "action" => "?type=" . ($this->getCurrentClass()) . "&action=add"
            ])
            ->setTemplate("Table/add_edit");
    }

    /**
     * Показывает страницу для редактирования строки
     */
    public function actionShowEdit(): void
    {
        $row = $this->model->getRow($_GET["id"]);
        unset($row["id"]);
        $this
            ->view
            ->addData([
                "comments" => $this->model->columnComments(),
                "row" => $row,
                "action" => "?type=" . ($this->getCurrentClass()) . "&action=edit&id=$_GET[id]"
            ])
            ->setTemplate("Table/add_edit");
    }

    /**
     * Добавляет новую строку
     */
    public function actionAdd(): void
    {
        $this->model->ins($_POST);
        $this->redirect("?type={$this->getCurrentClass()}&action=show");
    }


    /**
     * Редактирует строку из таблицы
     */
    public function actionEdit(): void
    {
        $this->model->upd($_GET["id"], $_POST);
        $this->redirect("?type={$this->getCurrentClass()}&action=show");
    }

}