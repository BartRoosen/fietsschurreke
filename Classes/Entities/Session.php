<?php

namespace Classes\Entities;

class Session
{
    /**
     * @var null | string
     */
    private $page = null;

    /**
     * @var string
     */
    private $picture = null;

    /**
     * @var int
     */
    private $bikeId;

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

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

    /**
     * @return int
     */
    public function getBikeId()
    {
        return $this->bikeId;
    }

    /**
     * @param int $bikeId
     */
    public function setBikeId($bikeId)
    {
        $this->bikeId = $bikeId;
    }
}
