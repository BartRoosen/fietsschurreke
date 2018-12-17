<?php

namespace Classes\Loaders;

use Classes\Config\LoaderConfig;

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
        $this->htmlTemplate = LoaderConfig::$CSS_TEMPLATE;
        $this->folder       = LoaderConfig::$CSS_FOLDER;

        parent::__construct();
    }
}
