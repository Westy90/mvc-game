<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);

use FastRoute\RouteCollector;

$router = $router ?? new RouteCollector(
    new \FastRoute\RouteParser\Std(),
    new \FastRoute\DataGenerator\MarkBased()
);


$router->addRoute("GET", "/test", function () {
    // A quick and dirty way to test the router or the request.
    return "Testing response";
});

$router->addRoute("GET", "/", "\Mos\Controller\Index");
$router->addRoute("GET", "/debug", "\Mos\Controller\Debug");
$router->addRoute("GET", "/twig", "\Mos\Controller\TwigView");


$router->addRoute("GET", "/dice", "\Mos\Controller\Dice");

$router->addRoute("POST", "/diceProcess", "\Mos\Controller\DiceProcess");
$router->addRoute("POST", "/diceReset", "\Mos\Controller\DiceReset");

$router->addRoute("POST", "/dice", "\Mos\Controller\Dice");

$router->addRoute("POST", "/diceSaveFirstHalf", "\Mos\Controller\DiceSave");

/*
$router->addGroup("/dice", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Dice", "Dice"]);
    $router->addRoute("GET", "/reset", ["\Mos\Controller\Dice", "reset"]);
});
*/



$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\Mos\Controller\Session", "destroy"]);
});


$router->addGroup("/some", function (RouteCollector $router) {
    $router->addRoute("GET", "/where", ["\Mos\Controller\Sample", "where"]);
});
