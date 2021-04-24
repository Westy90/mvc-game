<?php

declare(strict_types=1);

namespace Mos\Router;

use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

/**
 * Class Router.
 */
class Router
{
    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/") {
            $data = [
                "header" => "Index page",
                "message" => "Hello, this is the index page, rendered as a layout.",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session") {
            $body = renderView("layout/session.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session/destroy") {
            destroySession();
            redirectTo(url("/session"));
            return;
        } else if ($method === "GET" && $path === "/debug") {
            $body = renderView("layout/debug.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/twig") {
            $data = [
                "header" => "Twig page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderTwigView("index.html", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/some/where") {
            $data = [
                "header" => "Rainbow page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/form/view") {
            $data = [
                "header" => "Form",
                "message" => "Press submit to send the message to the result page.",
                "action" => url("/form/process"),
                "output" => $_SESSION["output"] ?? null,
            ];
            $body = renderView("layout/form.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/dice") {
            $data = [
                "header" => "Game of dice",
                "message" => "Choose if you wanna use 1 or 2 dices",
                "action" => url("/dice"),
                "numDice" => $_SESSION["numDice"] ?? null,
            ];



            $body = renderView("/layout/dice.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/dice") {
            if ($_POST["numDice"] !== null) {
                $_SESSION["numDice"] = $_POST["numDice"] ?? null;
                $_SESSION["stanna"] = $_POST["stanna"] ?? null;
            }
            redirectTo(url("/dice"));
            return;
        } else if ($method === "POST" && $path === "/diceRoll") {
                $_SESSION["diceHand"]->RollDices();
            redirectTo(url("/dice"));
            return;
        } else if ($method === "POST" && $path === "/diceStay") {
             $_SESSION["stay"] = $_POST["stay"];
            redirectTo(url("/dice"));
            return;
        } else if ($method === "POST" && $path === "/diceAnotherGame") {
            $_SESSION["diceHand"] = null;
            $_SESSION["ComputerDiceHand"] = null;
            $_SESSION["stay"] = null;
            $_SESSION["numDice"] = null;
            $_SESSION["sumOfDice"] = null;
            $_SESSION["gameOver"] = false;
            $_SESSION["instantWin"] = false;
            redirectTo(url("/dice"));
            return;
        } else if ($method === "POST" && $path === "/diceReset") {
            $_SESSION["diceHand"] = null;
            $_SESSION["ComputerDiceHand"] = null;
            $_SESSION["stay"] = null;
            $_SESSION["numDice"] = null;
            $_SESSION["sumOfDice"] = null;
            $_SESSION["gameOver"] = false;
            $_SESSION["instantWin"] = false;
            $_SESSION["ComputerPoints"] = 0;
            $_SESSION["humanPoints"] = 0;
            redirectTo(url("/dice"));
            return;
        } else if ($method === "POST" && $path === "/form/process") {
            $_SESSION["output"] = $_POST["content"] ?? null;
            redirectTo(url("/form/view"));
            return;
        }
        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];
        $body = renderView("layout/page.php", $data);
        sendResponse($body, 404);
    }
}
