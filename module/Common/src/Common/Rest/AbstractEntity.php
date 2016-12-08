<?php
/**
 * Created by PhpStorm.
 * User: hari
 * Date: 4/17/14
 * Time: 4:06 PM
 */

namespace Common\Rest;


class AbstractEntity {

    public function hydrate($record)
    {
        foreach ($record as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }
} 