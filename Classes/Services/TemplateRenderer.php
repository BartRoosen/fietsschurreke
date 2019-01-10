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
        $referenceDate = new \DateTime();
        $referenceDate->modify('-1 week');

        $this->getBikesByGender($page);
        $this->setTemplateHtml();

        foreach ($this->bikes as $bike) {
            if ($bike instanceof Bike) {
                $bikeInfoSubClass = ' for-sale';
                $sold             = 'no-label';
                $price            = '0.00';
                $sellDate         = \DateTime::createFromFormat('Y-m-d H:i:s', $bike->getSellDate());

                if ($bike->isSold() && $referenceDate > $sellDate) {
                    continue;
                }

                if ($bike->isSold()) {
                    $sold             = 'sold-label';
                    $bikeInfoSubClass = ' sold';
                }

                if (!(bool) $bike->isSold()) {
                    $createDate = \DateTime::createFromFormat('Y-m-d H:i:s', $bike->getCreateDate());

                    if ($referenceDate < $createDate) {
                        $sold             = 'new-label';
                        $bikeInfoSubClass = ' new';
                    }

                    $price = $bike->getPrice();
                }

                $pictureLink = null === $bike->getPictureLink() ? self::DEFAULT_FOTO : $bike->getPictureLink();
                $this->html  .= sprintf(
                    $this->templateHtml,
                    $bikeInfoSubClass,
                    $sold,
                    $pictureLink,
                    $bike->getBrandName(),
                    $bike->getType(),
                    $bike->getSizeFrame(),
                    $bike->getSizeWheel(),
                    '0.00' === $price ? '' : sprintf('€ %s', $price)
                );
            }
        }

        return $this->html;
    }
}
