<?php

namespace Classes\Services;

use Classes\Entities\Bike;

class TemplateRenderer
{
    const TEMPLATE_FOLDER = 'templates';
    const DEFAULT_FOTO    = 'img/bikes/foto.jpg';

    /**
     * @var string
     */
    private $html = '';

    /**
     * @var string
     */
    private $templateHtml = '';

    /**
     * @var DataFetcher
     */
    private $dataFetcher;

    /**
     * @var string
     */
    private $templateName;

    /**
     * @var array
     */
    private $bikes = [];

    /**
     * TemplateRenderer constructor.
     *
     * @param DataFetcher $dataFetcher
     * @param             $templateName
     */
    public function __construct(DataFetcher $dataFetcher, $templateName)
    {
        $this->dataFetcher  = $dataFetcher;
        $this->templateName = $templateName;
    }

    /**
     * @param $page
     */
    private function getBikesByGender($page)
    {
        $this->bikes = $this->dataFetcher->getBikesByGender($page);
    }

    /**
     *
     */
    private function setTemplateHtml()
    {
        $templates = scandir(self::TEMPLATE_FOLDER);

        foreach ($templates as $template) {
            if ($template === sprintf('%s.php', $this->templateName)) {
                $this->templateHtml = file_get_contents(sprintf('%s/%s', self::TEMPLATE_FOLDER, $template));
            }
        }
    }

    /**
     * @param $page
     *
     * @return string
     */
    public function renderBikeInfo($page)
    {
        $this->getBikesByGender($page);
        $this->setTemplateHtml();

        foreach ($this->bikes as $bike) {
            if ($bike instanceof Bike) {
                $sold       = $bike->isSold() ? 'sold-label' : 'no-label';
                $price      = $bike->getPrice();
                $pictureLink = null === $bike->getPictureLink() ? self::DEFAULT_FOTO : $bike->getPictureLink();
                $this->html .= sprintf(
                    $this->templateHtml,
                    $sold,
                    $pictureLink,
                    $bike->getType(),
                    $bike->getSizeFrame(),
                    $bike->getSizeWheel(),
                    '0.00' === $price ? 'niet bepaald' : sprintf('€ %s', $price)
                );
            }
        }

        return $this->html;
    }
}
