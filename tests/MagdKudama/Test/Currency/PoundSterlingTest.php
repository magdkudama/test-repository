<?php

namespace MagdKudama\Test\Currency;

use MagdKudama\Test\Currency;

class PoundSterlingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testFormattedValue($coin, $expected)
    {
        $currency = new PoundSterling();

        $this->assertEquals($expected, $currency->getFormattedValueFor($coin));
    }

    public function dataProvider()
    {
        return [
            ['4', '4p'],
            ['100', '£1'],
            ['400', '£4'],
            ['1', '1p']
        ];
    }
}
