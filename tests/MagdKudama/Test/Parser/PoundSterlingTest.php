<?php

namespace MagdKudama\Test\Parser;

use MagdKudama\Test\Currency\PoundSterling as PoundSterlingCurrency;

class PoundSterlingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validProvider
     */
    public function testCanonicalValue($amount, $expectedResult)
    {
        $parser = new PoundSterling(new PoundSterlingCurrency);
        $this->assertEquals($expectedResult, $parser->getCanonicalValue($amount));
    }

    /**
     * @dataProvider invalidProvider
     */
    public function testExceptionIsThrown($amount)
    {
        $this->setExpectedException('MagdKudama\Test\Parser\Exception\InvalidFormatException');

        $parser = new PoundSterling(new PoundSterlingCurrency);
        $parser->getCanonicalValue($amount);
    }

    public function validProvider()
    {
        return [
            ['4', 4],
            ['£2', 200],
            ['£1p', 100],
            ['£10', 1000],
            ['197p', 197],
            ['85', 85],
            ['1.87', 187],
            ['£1.23', 123],
            ['£1.87p', 187],
            ['£1.p', 100],
            ['001.41p', 141],
            ['4.235p', 424],
            ['£1.257422457p', 126]
        ];
    }

    public function invalidProvider()
    {
        return [
            [''],
            ['1x'],
            ['£1x.0p'],
            ['£p']
        ];
    }
}
