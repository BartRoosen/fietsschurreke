<?php

namespace Classes\Services;

class CarouselRenderer
{
    const PICTURE_FOLDER = 'img/ebike';
    const TEMPLATE       = 'templates/pictureCarousel.php';

    /**
     * @var array
     */
    private $pictureArray;

    /**
     * @var string
     */
    private $templateHtml;

    /**
     * @var string
     */
    private $html;

    private function getPictures()
    {
        $files = scandir(self::PICTURE_FOLDER);

        foreach ($files as $file) {
            if ('.' !== $file && '..' !== $file) {
                $this->pictureArray[] = $file;
            }
        }
    }

    private function getTemplateHtml()
    {
        $this->templateHtml = file_get_contents(self::TEMPLATE);
    }

    /**
     * CarouselRenderer constructor.
     */
    public function __construct()
    {
        $this->getPictures();
        $this->getTemplateHtml();
    }

    public function renderPictures()
    {
        $counter = 0;

        foreach ($this->pictureArray as $picture) {
            $active = '';
            $counter++;
            if (1 === $counter) {
                $active = ' active';
            }
            $picturePath = sprintf('img/ebike/%s', $picture);

            $this->html .= sprintf($this->templateHtml, $active, $picturePath);
        }

        return $this->html;
    }
}