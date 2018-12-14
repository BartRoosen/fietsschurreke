<?php

namespace Classes\Loaders;

/**
 * Class CssLoader
 *
 * @package Loaders
 */
class CssLoader extends AbstractLoader
{
    /**
     * CssLoader constructor.
     */
    public function __construct()
    {
        $this->htmlTemplate = '<link rel="stylesheet" href="%s/%s">';
        $this->folder       = 'css';

        parent::__construct();
    }
}
