<?php

namespace mawj15\Dice;

/**
* Showing off a standard class with methods and properties
*/

//include(__DIR__ . "/../PersonAgeException.php");

class DiceHand
{

    private $dices;
    private $values;
    private $sum;
    private $amountOfDice;
    private $totalSum = 0;

    public function __construct($pAmount = 5)
    {
        $this->dices = [];
        $this->values = [];
        $this->sum = 0;
        $this->amountOfDice = $pAmount;

        for ($i = 0; $i < $pAmount; $i++) {
            $this->dices[$i] = new GraphicalDice();
            $this->values[$i] = null;
            $this->sum += $this->dices[$i]->getDice();
            $this->totalSum = $this->totalSum + $this->sum;
        }
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

    public function getSum()
    {
        return $this->sum;
    }

    public function getAvg()
    {
        return $this->sum / count($this->dices);
    }


    public function rollDices()
    {
        $this->sum = 0;
        for ($i = 0; $i < $this->amountOfDice; $i++) {
            $this->dices[$i]->rollDice();
            $this->sum += $this->dices[$i]->getDice();
        }
        $this->totalSum = $this->totalSum + $this->sum;
    }

    public function getTotalSum()
    {
        return $this->totalSum;
    }
}
