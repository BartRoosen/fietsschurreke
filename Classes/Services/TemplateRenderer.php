<?php

namespace Classes\Services;

use Classes\Entities\Bike;

class TemplateRenderer
{
    const TEMPLATE_FOLDER  = 'templates';
    const DEFAULT_FOTO     = 'img/bikes/foto.jpg';
    const NAV_LINK         = 'navController.php?page=details&id=%s';
    const COVER_PHOTO_PATH = 'img/bikes/%s/1.jpg';

    const NO_BIKES_AVAILABLE = '<h2 class="no-bikes-available">Momenteel geen %sfietsen beschikbaar</h2>';

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

    private function createNavLink($id)
    {
        return sprintf(self::NAV_LINK, $id);
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

        if (empty($this->bikes)) {
            $title = '';
            switch ($page) {
                case 'men':
                    $title = 'heren';
                    break;
                case 'woman':
                    $title = 'dames';
                    break;
                case 'kids':
                    $title = 'kinder';
                    break;
            }

            return sprintf(self::NO_BIKES_AVAILABLE, $title);
        }

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

                $coverPhotoPath = sprintf(self::COVER_PHOTO_PATH, $bike->getId());

                $pictureLink = file_exists($coverPhotoPath) ? $coverPhotoPath : self::DEFAULT_FOTO;

                if (file_exists($coverPhotoPath)) {
                    $pictureLink = $coverPhotoPath;
                }

                $this->html .= sprintf(
                    $this->templateHtml,
                    $bikeInfoSubClass,
                    $sold,
                    $this->createNavLink($bike->getId()),
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
