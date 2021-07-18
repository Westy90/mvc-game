<?php

namespace mawj15\Dice;

/**
* Showing off a standard class with methods and properties
*/

//include(__DIR__ . "/../PersonAgeException.php");

class DiceHand
{
    private $dices;
    private $sum;
    private $average;
    private $amountOfDice;
    private $totalSum = 0;
    private $occurances;

    public function __construct($pAmount = 5)
    {
        $this->dices = [];
        $this->sum = 0;
        $this->amountOfDice = $pAmount;

        for ($i = 0; $i < $pAmount; $i++) {
            $this->dices[$i] = new GraphicalDice();
            $this->sum += $this->dices[$i]->getDice();
        }
        $this->totalSum = $this->totalSum + $this->sum;
    }

    public function getHand()
    {
        $dices = [];
        for ($i = 0; $i < count($this->dices); $i++) {
            $dices[$i] = $this->dices[$i]->getDice();
        }
        return $dices;
    }


    public function getGraphicHand()
    {
        $diceHand = [];
        for ($i = 0; $i < count($this->dices); $i++) {
            $diceHand[$i] = $this->dices[$i]->graphic();
        }
        return $diceHand;
    }


    public function numberOfDicesInHand()
    {
        return $this->amountOfDice;
    }

    public function getSum()
    {
        $this->sum = 0;

        for ($i = 0; $i < $this->amountOfDice; $i++) {
            $this->sum += $this->dices[$i]->getDice();
        }
        return $this->sum;
    }

    public function getAvg()
    {
        $this->average = 0;

        for ($i = 0; $i < $this->amountOfDice; $i++) {
            $this->average += $this->dices[$i]->getDice();
        }

        return $this->average / count($this->dices);
    }


    public function rollDices()
    {
        for ($i = 0; $i < $this->amountOfDice; $i++) {
            $this->dices[$i]->rollDice();
        }
    }

    public function rollSpecificDices($roll)
    {
        foreach ($roll as $value)
        {
            $this->dices[$value]->rollDice();
        }
    }

    public function setDices($die0, $die1, $die2, $die3, $die4)
    {
        $setDices = [$die0, $die1, $die2, $die3, $die4];

        for ($i = 0; $i < 5; $i++)
        {
            $this->dices[$i]->setRolledDice($setDices[$i]);
        }
    }





}
