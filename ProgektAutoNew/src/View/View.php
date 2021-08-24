<?php

namespace App\View;

class View
{
    /**
     * @var array<mixed>
     */
    protected array $data = [];
    protected string $template;

    /**
     * @param array<mixed> $data
     * @return $this
     */
    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param array<mixed> $data
     * @return $this
     */
    public function addData(array $data): static
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplate(string $template): static
    {
        $this->template = $template;
        return $this;
    }

    public function view(): void
    {
        include __DIR__ . "/../../templates/main.php";
    }

    public function body(): void
    {
        include __DIR__ . "/../../templates/$this->template.php";
    }

}