<?php

namespace MagdKudama\Test\Currency;

use MagdKudama\Test\Currency\Exception\InvalidPropertyException;

class Property {
    const POSITION_BEFORE = 'before';
    const POSITION_AFTER = 'after';

    private $symbol;
    private $position;

    public function __construct($symbol, $position)
    {
        $this->symbol = $symbol;

        if (!in_array($position, [self::POSITION_AFTER, self::POSITION_BEFORE])) {
            throw new InvalidPropertyException;
        }

        $this->position = $position;
    }

    public function getSymbol()
    {
        return $this->symbol;
    }

    public function getPosition()
    {
        return $this->position;
    }
}
