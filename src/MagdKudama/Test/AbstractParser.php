<?php

namespace MagdKudama\Test;

abstract class AbstractParser
{
    /**
     * @var Currency
     */
    private $currency;

    /**
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->currency = $currency;

        mb_internal_encoding('utf-8');
    }

    /**
     * @param $value
     * @param $symbol
     * @return bool
     */
    protected function hasSymbolAsFirstCharacter($value, $symbol)
    {
        return mb_substr($value, 0, 1) === $symbol;
    }

    /**
     * @param $value
     * @return string
     */
    protected function removeBufferedZeros($value)
    {
        if (strlen($value) > 2 && mb_substr($value, 0, 2) === '00') {
            return mb_substr($value, 2);
        }

        return $value;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function isFloating($value)
    {
        $decimalPosition = mb_strpos($value, '.');

        if ($decimalPosition === false) {
            return false;
        }

        $decimalPart = mb_substr($value, $decimalPosition + 1);

        if (mb_strlen($decimalPart) === 2) {
            return true;
        }

        return false;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param $amount
     * @return int
     */
    abstract function getCanonicalValue($amount);
}
