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
     * @param int|null $gender
     *
     * @return array
     */
    public function getBikes($gender = null)
    {
        $sql = 'SELECT
                  B.AI_BIKE AS bikeId,
                  B.QY_PRICE AS price,
                  B.FL_SOLD AS sold,
                  B.DT_SOLD AS sellDate,
                  BG.CD_GENDER AS gender,
                  BT.CD_TYPE AS bikeType,
                  SF.CD_SIZE_FRAME AS frameSize,
                  SW.CD_SIZE_WHEEL AS wheelSize,
                  P.UL_PICTURE AS pictureLink,
                  B.DT_CREATED AS createDate,
                  BR.NM_BRAND AS brandName
                FROM bikes B
                  LEFT JOIN bike_gender BG ON (B.AI_GENDER = BG.AI_GENDER)
                  LEFT JOIN bike_types BT ON (B.AI_TYPE = BT.AI_TYPE)
                  LEFT JOIN size_frame SF ON (B.AI_SIZE_FRAME = SF.AI_SIZE_FRAME)
                  LEFT JOIN size_wheel SW ON (B.AI_SIZE_WHEEL = SW.AI_SIZE_WHEEL)
                  LEFT JOIN pictures P ON (B.AI_BIKE = P.AI_BIKE AND P.FL_COVER = 1)
                  LEFT JOIN brands BR ON (B.AI_BRAND = BR.AI_BRAND)
                WHERE B.FL_DELETED = 0 AND B.FL_DISPLAY = 1';

        if ($gender !== null) {
            $filter = sprintf(' AND B.AI_GENDER = %s', $gender);
            $sql    .= $filter;
        }

        $sql .= ' ORDER BY B.DT_CREATED DESC;';

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
            $id   = $row['bikeId'];
            $bike = new Bike();
            $bike->setId($id);
            $bike->setPrice($row['price']);
            $bike->setSold($row['sold']);
            $bike->setSellDate($row['sellDate']);
            $bike->setGender($row['gender']);
            $bike->setType($row['bikeType']);
            $bike->setSizeFrame($row['frameSize']);
            $bike->setSizeWheel($row['wheelSize']);
            $bike->setPictureLink($row['pictureLink']);
            $bike->setCreateDate($row['createDate']);
            $bike->setBrandName($row['brandName']);

            $bikes[$id] = $bike;
        }

        return $bikes;
    }
}
