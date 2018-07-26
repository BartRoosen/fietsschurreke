<?php

namespace Classes\People;

class Person
{
    private $firstName;
    private $lastName;

    public function __construct()
    {
        $this->firstName = 'Bart';
        $this->lastName  = 'Roosen';
    }

    public function getFullName()
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }
}