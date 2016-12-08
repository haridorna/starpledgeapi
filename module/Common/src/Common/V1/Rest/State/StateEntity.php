<?php
namespace Common\V1\Rest\State;

class StateEntity
{
    public $id;
    public $country_id;
    public $state_name;
    public $state_short;

    public function hydrate($record)
    {
        foreach ($record as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }
}
