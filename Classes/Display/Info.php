<?php

namespace Classes\Display;

use Classes\Maps\Address;
use Classes\People\Person;

class Info
{
    private $fullName;
    private $address;

    /**
     * Info constructor.
     */
    public function __construct()
    {
        $this->fullName = new Person();
        $this->address  = new Address();
    }

    public function getInfo()
    {
        return sprintf(
            '<h1>%s</h1><hr><p>%s</p>',
            $this->fullName->getFullName(),
            $this->address->getAddress()
        );
    }
}