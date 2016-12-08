<?php
namespace Common\V1\Rest\City;

/**
 * Class CityEntity
 * @author Hari
 *
 * @package Common\V1\Rest\City
 */
class CityEntity
{
    public $id;
    public $state_id;
    public $name;
    public $county_name;
    public $state_abbreviation;
    public $primary_latitude;
    public $primary_longitude;

    /**
     * @param $record
     *
     * @return $this
     */
    public function hydrate($record)
    {
        foreach ($record as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }

    public function exchangeArray($data) {
        foreach ($record as $key => $value) {
            $this->$key = $value;
        }

        return $this;

    }
}
