<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

/**
 * Controller for the index route.
 */
class DiceProcess
{
    public function __invoke(): ResponseInterface
    {
        $specificDie = [];

        for ($i = 0; $i <= 4; $i++) {
            $diceNum = "DiceSpec-" . $i;
            if (isset($_POST[$diceNum])) {
                $specificDie[] = $i;
            }
        }
        $_SESSION["Yatzy"]->rollSpecificDices($specificDie);

        redirectTo(url("/dice"));
    }
}
