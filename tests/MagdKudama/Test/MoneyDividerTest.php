<?php

namespace MagdKudama\Test;

use MagdKudama\Test\Currency\PoundSterling as PoundSterlingParser;
use MagdKudama\Test\Parser\PoundSterling;

class MoneyDividerTest extends \PHPUnit_Framework_TestCase
{
    private $parser;

    public function setUp()
    {
        $this->parser = new PoundSterling(new PoundSterlingParser);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testDivider($amount, $expected)
    {
        $divider = new MoneyDivider($this->parser);
        $result = $divider->divideFor($amount);

        $this->assertEquals($expected, $result);
    }

    public function dataProvider()
    {
        return [
            ['4p', ['2p' => 2.0, '£2' => 0.0, '£1' => 0.0, '50p' => 0.0, '20p' => 0.0, '1p' => 0.0]],
            ['5p', ['2p' => 2.0, '£2' => 0.0, '£1' => 0.0, '50p' => 0.0, '20p' => 0.0, '1p' => 1.0]],
            ['55p', ['2p' => 2.0, '£2' => 0.0, '£1' => 0.0, '50p' => 1.0, '20p' => 0.0, '1p' => 1.0]],
            ['£1', ['2p' => 0.0, '£2' => 0.0, '£1' => 1.0, '50p' => 0.0, '20p' => 0.0, '1p' => 0.0]],
            ['£3', ['2p' => 0.0, '£2' => 1.0, '£1' => 1.0, '50p' => 0.0, '20p' => 0.0, '1p' => 0.0]],
            ['£3.01', ['2p' => 0.0, '£2' => 1.0, '£1' => 1.0, '50p' => 0.0, '20p' => 0.0, '1p' => 1.0]]
        ];
    }
}
