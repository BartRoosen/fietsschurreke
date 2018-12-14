<?php

namespace Classes\Entities;

/**
 * Class OpeningRepository
 *
 * @package Classes\Entities
 */
class OpeningRepository extends AbstractRepository
{
    /**
     * @return array
     */
    public function getOpeningHours()
    {
        $sql = 'SELECT
                  AI_OPEN as id,
                  DE_DAY as day,
                  TM_FROM as timeFrom,
                  TM_UNTIL as timeUntil,
                  FL_CLOSED as closed,
                  FL_DISPLAY as display
                FROM open WHERE FL_DELETED = 0;';

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
        $openingHours = [];
        foreach ($dataRows as $row) {
            $id = $row['id'];
            $opening = new Opening();
            $opening->setId($id);
            $opening->setDay($row['day']);
            $opening->setFrom($row['timeFrom']);
            $opening->setUntil($row['timeUntil']);
            $opening->setClosed($row['closed']);
            $opening->setDisplay($row['display']);

            $openingHours[$id] = $opening;
        }

        return $openingHours;
    }
}
