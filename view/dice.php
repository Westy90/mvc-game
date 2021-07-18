<?php

use function Mos\Functions\{
    url,
    redirectTo
};

$header = $header ?? null;
$message = $message ?? null;
$action = $action ?? null;
$specificDie = $specificDie ?? null;

$_SESSION["Yatzy"] = $_SESSION["Yatzy"] ?? null;

if (!$_SESSION["Yatzy"]) {
    $_SESSION["Yatzy"] = new \mawj15\Dice\Yatzy();
} ?>


<h1><?= $header ?></h1>

<p> Select the dice you would like to roll again </p>
    <form method="POST" action="<?= url("/diceProcess") ?>">

    <p class="dice-utf8">
        <?php $numDice = 0; ?>
        <?php foreach ($_SESSION["Yatzy"]->getDiceHand() as $value) : ?>
            <b class="<?= $value ?>"></b>
            <input type=checkbox name="DiceSpec-<?= $numDice ?>" value = "<?= $numDice ?>">

            <?php $numDice++ ?>
            <br>
        <?php endforeach; ?>
        <?php if ($_SESSION["Yatzy"]->getRound() < 3) : ?>
            <input type=submit value="Roll">
        <?php endif; ?>
    </p>
</form>

<?php echo "Round: " . $_SESSION["Yatzy"]->getRound() . " of 3."?>
<br>
<?php echo "Sum of dice: " . $_SESSION["Yatzy"]->getSumYatzy(); ?>
<br><br>


<!-- skapa en tabell där man väljer var man vill spara sina tärningskast någonstans -->


<form method="POST" action="<?= url("/diceSaveFirstHalf") ?>">
    <table>
        <tr>
            <td>Die</td>
            <td>Keep/ed (points)</td>
            <td># this roll (points)</td>
        </tr>

        <?php for ($i = 1; $i <= 6; $i++) : ?>
            <tr>
                <td><?= $i ?></td>

                <?php if (isset($_SESSION["Yatzy"]->getFirstHalf()[$i])) : ?>
                    <td><?= $_SESSION["Yatzy"]->getFirstHalf()[$i]; ?> | (<?= $_SESSION["Yatzy"]->getFirstHalf()[$i] * $i; ?>)</td>
                <?php else : ?>
                    <td> <input type="radio" name="keepDice" value="<?= $i . "," . $_SESSION["Yatzy"]->getHandOccurances()[$i]?>"> </td>
                <?php endif; ?>

                <td><?= $_SESSION["Yatzy"]->getHandOccurances()[$i]?> | (<?= $_SESSION["Yatzy"]->getHandOccurances()[$i] * $i?>)</td>
            </tr>

            <?php if ($i === 6 && $_SESSION["Yatzy"]->getFirstHalfSum() > 63) : ?>
                <?php $_SESSION["Yatzy"]->setBonus(); ?>
            <?php endif; ?>


        <?php endfor; ?>

    </table>


    <p>
        <input type=submit value="Save">
    </p>

    <p>
        Sum of first half: <?= $_SESSION["Yatzy"]->getFirstHalfSum() ?>
    </p>
</form>


<p>
    <?php
        echo "<form method='post' action=" . url("/diceReset") . ">";
        echo "<input type=submit name='Reset scoreboard' value='Play again'>";
        echo "</form>";
    ?>
</p>

<pre>
<?= var_dump($_SESSION["Yatzy"]->getFirstHalf()) ?>
</pre>

<pre>
<?= var_dump($_SESSION["Yatzy"]->getFirstHalfSum()) ?>
</pre>
