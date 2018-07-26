<?php

namespace Classes\Maps;

class Address
{
    private $street;
    private $city;

    public function __construct()
    {
        $this->street = 'Kauterstraat';
        $this->city   = 'Kumtich';
    }

    public function getAddress()
    {
        return sprintf('%s, %s', $this->street, $this->city);
    }
}