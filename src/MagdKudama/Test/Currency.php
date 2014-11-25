<?php

namespace MagdKudama\Test;

use MagdKudama\Test\Currency\Property;

interface Currency
{
    /**
     * @return array
     */
    function getValidCoins();

    /**
     * @return Property
     */
    function getNoteProperty();

    /**
     * @return Property
     */
    function getCoinProperty();

    /**
     * @param int $value
     * @return string
     */
    function getFormattedValueFor($value);
}
