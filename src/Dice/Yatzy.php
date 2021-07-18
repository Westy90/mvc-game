<?php

namespace mawj15\Dice;

/**
* Yatzy class
*/

class Yatzy
{
    private $diceHand;

    private $round;

    private $firstHalf = [];

    private $firstHalfSum = 0;

    public function __construct()
    {
        $this->diceHand = new DiceHand();
        $this->round = 1;
    }

    public function getDiceHand()
    {
        return $this->diceHand->getGraphicHand();
    }


    public function getDiceHandNumeric()
    {
        return $this->diceHand->getHand();
    }

    public function getFullDiceHand()
    {
        return $this->diceHand;
    }

    public function rollSpecificDices($specificDie)
    {
        $this->diceHand->rollSpecificDices($specificDie);
        $this->round++;
    }


    public function getSumYatzy()
    {
        return $this->diceHand->getSum();
    }

    public function getAvgYatzy()
    {
        return $this->diceHand->getAvg();
    }

    public function getRound()
    {
        return $this->round;
    }


    public function getHandOccurances()
    {
        $occurances = [0, 0, 0, 0, 0, 0, 0];
        for ($i = 1; $i < 7; $i++)
        {
            for ($j = 0; $j < $this->diceHand->numberOfDicesInHand(); $j++)
            {
                if ($this->diceHand->getHand()[$j] === $i)
                {
                    $occurances[$i] = $occurances[$i] + 1;
                }
            }
        }
        return $occurances;
    }

    public function setSaveFirstHalf($pDie, $pSum)
    {
        $this->firstHalf[$pDie] = $pSum;

        $this->firstHalfSum = $this->firstHalfSum + ($pDie * $pSum);
    }

    public function setBonus()
    {
        $this->firstHalfSum = $this->firstHalfSum + 50;
    }

    public function getFirstHalf()
    {

        return $this->firstHalf;
    }

    public function getFirstHalfSum()
    {
        return $this->firstHalfSum;
    }


    public function resetHand()
    {
        $this->diceHand = new DiceHand();
        $this->round = 1;
    }


    public function setDicesInHand($die0, $die1, $die2, $die3, $die4)
    {
        $this->diceHand->setDices($die0, $die1, $die2, $die3, $die4);
    }



}
