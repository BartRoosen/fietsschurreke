<?php

namespace Classes\Loaders;

use Classes\Config\LoaderConfig;

/**
 * Class JsLoader
 *
 * @package Classes\Loaders
 */
class JsLoader extends AbstractLoader
{
    /**
     * JsLoader constructor.
     */
    public function __construct()
    {
        $this->htmlTemplate = LoaderConfig::$JS_TEMPLATE;
        $this->folder       = LoaderConfig::$JS_FOLDER;

        parent::__construct();
    }
}
