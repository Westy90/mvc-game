<?php

namespace mawj15\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class YatzyCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $yatzy = new Yatzy();
        $this->assertInstanceOf("\mawj15\Dice\Yatzy", $yatzy);

        $diceHand = $yatzy->getFullDiceHand();
        $this->assertInstanceOf("\mawj15\Dice\DiceHand", $diceHand);

        $res = $yatzy->getRound();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    public function testGetDiceHand()
    {
        $yatzy = new Yatzy();

        $res = $yatzy->getDiceHand();
        $exp = 5;
        $this->assertCount($exp, $res);

    }


    public function testRollSpecificDices()
    {
        $yatzy = new Yatzy();

        $yatzy->rollSpecificDices([0, 1, 2, 3, 4]);

        //test round++
        $res = $yatzy->getRound();
        $exp = 2;
        $this->assertEquals($exp, $res);


        //Check that the dices are rolled

        $rolledDices = $yatzy->getDiceHandNumeric();


        for ($i = 0; $i < 5; $i++)
        {
            $this->assertThat(
                $rolledDices[$i],
                $this->logicalAnd(
                    $this->greaterThanOrEqual(1),
                    $this->lessThanOrEqual(6)
                    )
                );
        }
    }

    public function testGetSum()
    {
        $yatzy = new Yatzy();

        $yatzy->setDicesInHand(1,1,1,1,1);


        $res = $yatzy->getSumYatzy();
        $exp = 5;
        $this->assertEquals($exp, $res);
    }

    public function testGetAvg()
    {
        $yatzy = new Yatzy();

        $yatzy->setDicesInHand(1,1,3,5,5);


        $res = $yatzy->getAvgYatzy();
        $exp = 3;
        $this->assertEquals($exp, $res);
    }


    public function testGetHandOccurances()
    {
        $yatzy = new Yatzy();

        $yatzy->setDicesInHand(1,1,3,5,5);


        $res = $yatzy->getHandOccurances();
        $exp = [0, 2, 0, 1, 0, 2, 0];
        $this->assertEquals($exp, $res);
    }


    public function testSetSaveFirstHalf()
    {
        $yatzy = new Yatzy();

        //Sparar 2 stycken tärningar av valören 2 = 4 summa
        $yatzy->setSaveFirstHalf(2, 2);

        //Sparar 4 stycken tärningar av valören 3 = 12 summa
        $yatzy->setSaveFirstHalf(3, 4);


        $res = $yatzy->getFirstHalf();
        $exp[3] = 4;
        $exp[2] = 2;
        $this->assertEquals($exp, $res);
    }


    public function testGetFirstHalfSum()
    {
        $yatzy = new Yatzy();

        //Sparar 2 stycken tärningar av valören 2 = 4 summa
        $yatzy->setSaveFirstHalf(2, 2);

        //Sparar 4 stycken tärningar av valören 3 = 12 summa
        $yatzy->setSaveFirstHalf(3, 4);

        $res = $yatzy->getFirstHalfSum();
        $exp = 16;
        $this->assertEquals($exp, $res);
    }


    public function testSetBonus()
    {
        $yatzy = new Yatzy();

        //Sparar 5 stycken tärningar av valören 6 = 30 summa
        $yatzy->setSaveFirstHalf(6, 5);

        //Sparar 5 stycken tärningar av valören 5 = 25 summa
        $yatzy->setSaveFirstHalf(5, 5);

        //Sparar 5 stycken tärningar av valören 4 = 20 summa
        $yatzy->setSaveFirstHalf(4, 5);

        //Sätter en bonus på summan
        $yatzy->setBonus();

        $res = $yatzy->getFirstHalfSum();
        $exp = 75+50;
        $this->assertEquals($exp, $res);
    }




    public function testResetHand()
    {
        $yatzy = new Yatzy();

        //Gör lite operationer så det finns något att resetta
        $yatzy->rollSpecificDices([1, 2, 4]);

        $yatzy->resetHand();

        $res = $yatzy->getRound();
        $exp = 1;
        $this->assertEquals($exp, $res);

        $diceHand = $yatzy->getFullDiceHand();
        $this->assertInstanceOf("\mawj15\Dice\DiceHand", $diceHand);

    }


}
