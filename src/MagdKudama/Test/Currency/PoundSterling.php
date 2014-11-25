<?php

namespace MagdKudama\Test\Currency;

use MagdKudama\Test\Currency;

class PoundSterling implements Currency
{
    public function getValidCoins()
    {
        return [
            200,
            100,
            50,
            20,
            2,
            1
        ];
    }

    public function getNoteProperty()
    {
        return new Property('£', Property::POSITION_BEFORE);
    }

    public function getCoinProperty()
    {
        return new Property('p', Property::POSITION_AFTER);
    }

    public function getFormattedValueFor($coin)
    {
        $result = '';

        if ($coin >= 100) {
            if ($this->getNoteProperty()->getPosition() === Property::POSITION_BEFORE) {
                $result .= $this->getNoteProperty()->getSymbol();
            }

            $result .= floor($coin / 100);

            if ($this->getNoteProperty()->getPosition() === Property::POSITION_AFTER) {
                $result .= $this->getNoteProperty()->getSymbol();
            }
        } else {
            if ($this->getCoinProperty()->getPosition() === Property::POSITION_BEFORE) {
                $result .= $this->getCoinProperty()->getSymbol();
            }

            $result .= $coin;

            if ($this->getCoinProperty()->getPosition() === Property::POSITION_AFTER) {
                $result .= $this->getCoinProperty()->getSymbol();
            }
        }

        return $result;
    }
}
