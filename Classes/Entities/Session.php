<?php

namespace Classes\Entities;

class Session
{
    /**
     * @var null | string
     */
    private $page = null;

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }
}
