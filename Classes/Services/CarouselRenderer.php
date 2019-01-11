<?php

namespace Classes\Services;

class CarouselRenderer
{
    const TEMPLATE_PICTURES = 'templates/pictureCarousel.php';
    const TEMPLATE_CAROUSEL = 'templates/carousel.php';
    const NO_PICTURES       = '<h2>Geen foto\'s beschikbaar</h2>';

    /**
     * @var string
     */
    private $pictureFolder;

    /**
     * @var array
     */
    private $pictureArray;

    /**
     * @var string
     */
    private $picturesHtml;

    /**
     * @var string
     */
    private $carouselHtml;

    /**
     * @var bool
     */
    private $isFolder = true;

    /**
     * @var string
     */
    private $html;

    /**
     *
     */
    private function getPictures()
    {
        $files = scandir($this->pictureFolder);

        foreach ($files as $file) {
            if ('.' !== $file && '..' !== $file) {
                $this->pictureArray[] = $this->pictureFolder . $file;
            }
        }
    }

    /**
     * @return bool
     */
    private function isFolderValid()
    {
        if (!file_exists($this->pictureFolder)) {
            $this->isFolder = false;
            return false;
        }

        return true;
    }

    private function getTemplateHtml()
    {
        $this->picturesHtml = file_get_contents(self::TEMPLATE_PICTURES);
        $this->carouselHtml = file_get_contents(self::TEMPLATE_CAROUSEL);
    }

    /**
     * CarouselRenderer constructor.
     *
     * @param $pictureFolder string
     */
    public function __construct($pictureFolder)
    {
        $this->pictureFolder = $pictureFolder;

        if ($this->isFolderValid()) {
            $this->getPictures();
            $this->getTemplateHtml();
        }
    }

    /**
     * @return string
     */
    private function renderPictures()
    {
        $counter = 0;

        foreach ($this->pictureArray as $picturePath) {
            $active = '';
            $counter++;
            if (1 === $counter) {
                $active = ' active';
            }
//            $picturePath = sprintf('img/ebike/%s', $picture);

            $this->html .= sprintf($this->picturesHtml, $active, $picturePath);
        }

        return $this->html;
    }

    /**
     * @param $title string
     *
     * @return string
     */
    public function renderCarousel($title)
    {
        if ($this->isFolder) {
            return sprintf(
                $this->carouselHtml,
                $title,
                $this->renderPictures()
            );
        }

        return self::NO_PICTURES;
    }
}
