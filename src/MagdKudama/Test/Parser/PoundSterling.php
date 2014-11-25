<?php

namespace MagdKudama\Test\Parser;

use MagdKudama\Test\AbstractParser;
use MagdKudama\Test\Parser;
use MagdKudama\Test\Parser\Exception\InvalidFormatException;

class PoundSterling extends AbstractParser
{
    public function getCanonicalValue($amount)
    {
        $canonicalValue = $this->getValueStripped($amount);

        if ($this->hasSymbolAsFirstCharacter($amount, $this->getCurrency()->getNoteProperty()->getSymbol())) {
            $canonicalValue = $canonicalValue * 100;
        }

        if ($this->isFloating($canonicalValue)) {
            $canonicalValue = $canonicalValue * 100;
        }

        return $canonicalValue;
    }

    private function getValueStripped($amount) {
        $resultantAmount = str_replace($this->getCurrency()->getNoteProperty()->getSymbol(), '', $amount);
        $resultantAmount = str_replace($this->getCurrency()->getCoinProperty()->getSymbol(), '', $resultantAmount);

        if (!is_numeric($resultantAmount)) {
            throw new InvalidFormatException;
        }

        $resultantAmount = $this->removeBufferedZeros($resultantAmount);

        return round($resultantAmount, 2);
    }
}
