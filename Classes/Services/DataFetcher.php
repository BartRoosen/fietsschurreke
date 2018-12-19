<?php

namespace Classes\Services;

use Classes\Config\Gender;
use Classes\Entities\BikeRepository;

class DataFetcher
{
    /**
     * @var BikeRepository
     */
    private $bikeRepo;

    /**
     * DataFetcher constructor.
     *
     * @param BikeRepository $bikeRepo
     */
    public function __construct(BikeRepository $bikeRepo)
    {
        $this->bikeRepo = $bikeRepo;
    }

    /**
     * @param $page
     *
     * @return array
     */
    public function getBikesByGender($page)
    {
        $gender = null;

        switch ($page) {
            case 'men':
                $gender = Gender::MEN;
                break;
            case 'woman':
                $gender = Gender::WOMAN;
                break;
            case 'kids':
                $gender = Gender::KIDS;
                break;
        }

        return $this->bikeRepo->getBikes($gender);
    }
}
