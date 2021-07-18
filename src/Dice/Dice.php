<?php

namespace mawj15\Dice;

/**
* Dice class
*/

//include(__DIR__ . "/../PersonAgeException.php");

class Dice
{
    /**
    * @var integer  $roll   The value of the dice
    */
    private $rolledDice;
    private $maxValue;

    public function __construct($pMax = 6)
    {
        $this->maxValue = $pMax;
        $this->rolledDice = rand(1, $this->maxValue);
    }


    public function setDiceSides($pMax = 6)
    {
        $this->maxValue = $pMax;
    }

    public function rollDice()
    {
        $this->rolledDice = rand(1, $this->maxValue);
    }

    public function getDice()
    {
        return $this->rolledDice;
    }

    public function getMax()
    {
        return $this->maxValue;
    }

    public function setRolledDice($pDie)
    {
        $this->rolledDice = $pDie;
    }



}
