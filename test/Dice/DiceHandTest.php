<?php

namespace mawj15\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceHandCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $noOfDiceExp = 5;

        $dicehand = new DiceHand();
        $this->assertInstanceOf("\mawj15\Dice\DiceHand", $dicehand);

        $this->assertThat(
            $dicehand->getSum(),
            $this->logicalAnd(
                $this->greaterThanOrEqual(1 * $noOfDiceExp),
                $this->lessThanOrEqual(6 * $noOfDiceExp)
            )
        );

        $res = $dicehand->numberOfDicesInHand();
        $exp = $noOfDiceExp;
        $this->assertEquals($exp, $res);
    }


    public function testCreateObjectOneArgument()
    {

        $noOfDiceExp = 10;

        $dicehand = new DiceHand($noOfDiceExp);
        $this->assertInstanceOf("\mawj15\Dice\DiceHand", $dicehand);


        $this->assertThat(
            $dicehand->getSum(),
            $this->logicalAnd(
                $this->greaterThanOrEqual(1 * $noOfDiceExp),
                $this->lessThanOrEqual(6 * $noOfDiceExp)
            )
        );

        $res = $dicehand->numberOfDicesInHand();
        $exp = $noOfDiceExp;
        $this->assertEquals($exp, $res);
    }

    public function testrollDices()
    {

        $dicehand = new DiceHand();
        $this->assertInstanceOf("\mawj15\Dice\DiceHand", $dicehand);


        $dicehand->rollDices();

        $dices = $dicehand->getHand();

        for($i = 0; $i < 5; $i++)
        {
            $this->assertThat(
                $dices[$i],
                $this->logicalAnd(
                    $this->greaterThanOrEqual(1),
                    $this->lessThanOrEqual(6)
                )
            );
        }
    }

}
