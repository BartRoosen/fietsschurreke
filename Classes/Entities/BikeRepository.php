<?php

namespace Classes\Entities;

/**
 * Class BikeRepository
 *
 * @package Classes\Entities
 */
class BikeRepository extends AbstractRepository
{
    /**
     * @return array
     */
    public function getBikes()
    {
        $sql = 'SELECT
                  B.AI_BIKE AS bikeId,
                  B.FL_SOLD AS sold,
                  B.DT_SOLD AS sellDate,
                  BG.CD_GENDER AS gender,
                  BT.CD_TYPE AS bikeType,
                  SF.CD_SIZE_FRAME AS frameSize,
                  SW.CD_SIZE_WHEEL AS wheelSize
                FROM bikes B
                  LEFT JOIN bike_gender BG ON (B.AI_GENDER = BG.AI_GENDER)
                  LEFT JOIN bike_types BT ON (B.AI_TYPE = BT.AI_TYPE)
                  LEFT JOIN size_frame SF ON (B.AI_SIZE_FRAME = SF.AI_SIZE_FRAME)
                  LEFT JOIN size_wheel SW ON (B.AI_SIZE_WHEEL = SW.AI_SIZE_WHEEL)
                WHERE B.FL_DELETED = 0;';

        $dataRows = $this->fetchAll($sql);

        if (empty($dataRows)) {
            return [];
        }

        return $this->hydrate($dataRows);
    }

    /**
     * @param array $dataRows
     *
     * @return array
     */
    private function hydrate(array $dataRows)
    {
        $bikes = [];
        foreach ($dataRows as $row) {
            $id = $row['bikeId'];
            $bike = new Bike();
            $bike->setId($id);
            $bike->setSold($row['sold']);
            $bike->setSellDate($row['sellDate']);
            $bike->setGender($row['gender']);
            $bike->setType($row['bikeType']);
            $bike->setSizeFrame($row['frameSize']);
            $bike->setSizeWheel($row['wheelSize']);

            $bikes[$id] = $bike;
        }

        return $bikes;
    }
}
