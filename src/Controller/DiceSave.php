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
class DiceSave
{
    public function __invoke(): ResponseInterface
    {

        $keepDice = explode(",", $_POST["keepDice"]);

        $_SESSION["Yatzy"]->setSaveFirstHalf($keepDice[0], $keepDice[1]);

        $_SESSION["Yatzy"]->resetHand();

        redirectTo(url("/dice"));
    }
}


//
