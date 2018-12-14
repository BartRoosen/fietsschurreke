<?php

namespace Classes\Loaders;

class AbstractLoader
{
    /**
     * @var array
     */
    protected $files = [];

    /**
     * @var string
     */
    protected $folder = '';

    /**
     * @var string
     */
    protected $output = '';

    /**
     * @var string
     */
    protected $htmlTemplate = '';

    /**
     * AbstractLoader constructor.
     */
    public function __construct()
    {
        $this->getFiles();
        $this->createHtml();
    }

    protected function getFiles()
    {
        $folderContent = scandir($this->folder);

        foreach ($folderContent as $item) {
            if ('.' !== $item && '..' !== $item) {
                $this->files[] = $item;
            }
        }
    }

    protected function createHtml()
    {
        foreach ($this->files as $file) {
            $this->output .= sprintf($this->htmlTemplate, $this->folder, $file);
        }
    }

    public function getHtml()
    {
        return $this->output;
    }
}
