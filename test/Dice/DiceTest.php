<?php

namespace mawj15\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\mawj15\Dice\Dice", $dice);

        $res = $dice->getMax();
        $exp = 6;
        $this->assertEquals($exp, $res);
    }


    public function testCreateObjectOneArgument()
    {
        $dice = new Dice(2);
        $this->assertInstanceOf("\mawj15\Dice\Dice", $dice);

        $res = $dice->getMax();
        $exp = 2;
        $this->assertEquals($exp, $res);
    }

    public function testSetSides()
    {
        $dice = new Dice();

        $dice->setDiceSides(4);

        $res = $dice->getMax();
        $exp = 4;
        $this->assertEquals($exp, $res);
    }


}
