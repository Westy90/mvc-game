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
class DiceReset
{
    public function __invoke(): ResponseInterface
    {
        $_SESSION["Yatzy"] = [];

        redirectTo(url("/dice"));
    }
}
