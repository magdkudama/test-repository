<?php

namespace MagdKudama\Test;

class MoneyDivider {
    /**
     * @var AbstractParser
     */
    private $parser;

    /**
     * @param AbstractParser $parser
     */
    public function __construct(AbstractParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param $amount
     * @return array
     */
    public function divideFor($amount)
    {
        $totalValue = $this->parser->getCanonicalValue($amount);
        $validCoins = $this->parser->getCurrency()->getValidCoins();
        arsort($validCoins);

        return $this->calculateCoins($totalValue, $validCoins);
    }

    /**
     * @param $amount
     * @param $validCoins
     * @return array
     */
    private function calculateCoins($amount, $validCoins)
    {
        $result = [];

        for ($i = 0; $i < count($validCoins); $i++) {
            $coins = floor($amount / $validCoins[$i]);

            $index = $this->parser->getCurrency()->getFormattedValueFor($validCoins[$i]);
            $result[$index] = $coins;

            $amount -= $coins * $validCoins[$i];
        }

        return $result;
    }
}
