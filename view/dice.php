<?php

use function Mos\Functions\{
    url,
    redirectTo
};

$header = $header ?? null;
$message = $message ?? null;
$action = $action ?? null;

$_SESSION["diceHand"] = $_SESSION["diceHand"] ?? null;
$_SESSION["ComputerDiceHand"] = $_SESSION["ComputerDiceHand"] ?? null;
$_SESSION["stay"] = $_SESSION["stay"] ?? null;
$_SESSION["numDice"] = $_SESSION["numDice"] ?? null;
$_SESSION["sumOfDice"] = $_SESSION["sumOfDice"] ?? null;
$_SESSION["gameOver"] = $_SESSION["gameOver"] ?? false;
$_SESSION["instantWin"] = $_SESSION["instantWin"] ?? false;
$_SESSION["ComputerPoints"] = $_SESSION["ComputerPoints"] ?? 0;
$_SESSION["humanPoints"] = $_SESSION["humanPoints"] ?? 0;

?>
<h1><?= $header ?></h1>

<?php if ($_SESSION["numDice"] === null) : ?>
    <form method="post" action="<?= $action ?>">
        <p><?= $message ?></p>
        <input type=submit name="numDice" value=1>
        <input type=submit name="numDice" value=2>
    </form>

<?php else : ?>
    <p> You are using <?= $_SESSION["numDice"] ?> dices </p>
<?php endif; ?>

<?php if ($_SESSION["numDice"] !== null && $_SESSION["instantWin"] === false && $_SESSION["gameOver"] === false) : ?>
    <?php if ($_SESSION["diceHand"] === null) {
        $_SESSION["diceHand"] = new \mawj15\Dice\DiceHand($_SESSION["numDice"]);
    } ?>

    <?php if ($_SESSION["stay"] !== "stay") : ?>
        <p class="dice-utf8">
        <?php foreach ($_SESSION["diceHand"]->getGraphicHand() as $value) : ?>
            <b class="<?= $value ?>"></b>
        <?php endforeach; ?>
        </p>

        <?php echo "Your total sum is " . $_SESSION["diceHand"]->getTotalSum(); ?>

        <?php if ($_SESSION["diceHand"]->getTotalSum() === 21) {
            $_SESSION["instantWin"] = true;
        } ?>

        <?php if ($_SESSION["diceHand"]->getTotalSum() > 21) {
            $_SESSION["gameOver"] = true;
            header("Refresh: 0;");
        } ?>

            <p>Choose if you wanna stay or roll one more time</p>
            <form method="post" action="<?= url("/diceRoll") ?>">
                <input type=submit name="roll" value="roll">
            </form>
            <br>
            <form method="post" action="<?= url("/diceStay") ?>">
                <input type=submit name="stay" value="stay">
            </form>

    <?php else : ?>
            <p> You choosed to stay! </p>
    <?php endif; ?>


<?php endif; ?>

<?php if ($_SESSION["stay"] === "stay") : ?>
    <?php $_SESSION["ComputerDiceHand"] = new \mawj15\Dice\DiceHand($_SESSION["numDice"]); ?>

    <?php while ($_SESSION["diceHand"]->getTotalSum() > $_SESSION["ComputerDiceHand"]->getTotalSum() && $_SESSION["ComputerDiceHand"]->getTotalSum() < 21) : ?>
        <?php $_SESSION["ComputerDiceHand"]->rollDices(); ?>
    <?php endwhile; ?>

    <?php
    if ($_SESSION["ComputerDiceHand"]->getTotalSum() >= $_SESSION["diceHand"]->getTotalSum() && $_SESSION["ComputerDiceHand"]->getTotalSum() <= 21) {
        $_SESSION["gameOver"] = true;
        $_SESSION["instantWin"] = false;
    } else {
        $_SESSION["instantWin"] = true;
        $_SESSION["gameOver"] = false;
    } ?>
<?php endif; ?>

<p>
<?php
if ($_SESSION["instantWin"] || $_SESSION["gameOver"]) {
    if ($_SESSION["instantWin"] === true) {
        echo "You won! Congratulations!!!";
        $_SESSION["humanPoints"] = $_SESSION["humanPoints"] + 1;
    }
    if ($_SESSION["gameOver"] === true) {
        echo "You lost!!!!!!";
        $_SESSION["ComputerPoints"] = $_SESSION["ComputerPoints"] + 1;
    }
    echo "<p> Your total sum is " . $_SESSION["diceHand"]->getTotalSum() . "</p>";

    if ($_SESSION["ComputerDiceHand"]) {
        echo "The computer got in total: " . $_SESSION["ComputerDiceHand"]->getTotalSum() . "</p>";
    }

    echo "<p> Scoreboard: </p>";
    echo "<p> You got " . $_SESSION["humanPoints"] . " | Computer got " . $_SESSION["ComputerPoints"] . "</p>";

    echo "<p>Choose if you wanna quit or play one more time</p>";

    echo "<form method='post' action=" . url("/diceAnotherGame") . ">";
    echo "<input type=submit name='Another round' value='Another round'>";
    echo "</form>";

    echo "<form method='post' action=" . url("/diceReset") . ">";
    echo "<input type=submit name='Reset scoreboard' value='Reset scoreboard'>";
    echo "</form>";
}
?>
</p>
