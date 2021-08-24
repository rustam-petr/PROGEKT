<?php

use W1020\HTML\Pagination;
use W1020\HTML\Table;
unset($this->data["comments"]["edit"]);
unset($this->data["comments"]["del"]);
echo (new Table())
    ->setData($this->data["table"])
    ->setHeaders($this->data["comments"])
    ->setClass("table table-striped table-hover")
    ->html();
echo (new Pagination())
    ->setUrlPrefix("?type={$this->data['controllerName']}&action=show&page=")
    ->setPageCount($this->data["pageCount"])
    ->setActivePage($this->data["activePage"])
    ->html();


