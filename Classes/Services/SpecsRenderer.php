<?php

namespace Classes\Services;

use Classes\Entities\Bike;
use Classes\Entities\BikeRepository;

class SpecsRenderer
{
    const TEMPLATE_SPECS = 'templates/bikeSpecs.php';
    const DEFAULT_OUTPUT = '<h2>Specificaties</h2><div>Geen data beschikbaar</div>';

    /**
     * @var string
     */
    private $specsHtml;

    /**
     * @var BikeRepository
     */
    private $bikeRepo;

    /**
     * SpecsRenderer constructor.
     */
    public function __construct()
    {
        $this->getTemplateHtml();
        $this->bikeRepo = new BikeRepository();
    }

    private function getTemplateHtml()
    {
        $this->specsHtml = file_get_contents(self::TEMPLATE_SPECS);
    }

    /**
     * @param int $bikeId
     *
     * @return string
     */
    public function getBikeSpecs($bikeId)
    {
        $bikeArray = $this->bikeRepo->getBikes(['id' => $bikeId]);

        foreach ($bikeArray as $bike) {
            if ($bike instanceof Bike) {
                return sprintf(
                    $this->specsHtml,
                    $bike->getBrandName(),
                    $bike->getType(),
                    $bike->getSizeFrame(),
                    $bike->getSizeWheel(),
                    $bike->getPrice()
                );
            }
        }

        return self::DEFAULT_OUTPUT;
    }
}
