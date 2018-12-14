<?php

namespace Classes\Loaders;

/**
 * Class JsLoader
 *
 * @package Classes\Loaders
 */
class JsLoader extends AbstractLoader
{
    /**
     * CssLoader constructor.
     */
    public function __construct()
    {
        $this->htmlTemplate = '<script src="%s/%s"></script>';
        $this->folder       = 'js';

        parent::__construct();
    }
}
