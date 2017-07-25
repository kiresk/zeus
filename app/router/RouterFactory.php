<?php

namespace App\Router;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\Utils\Strings;

class RouterFactory {
    use Nette\StaticClass;

    public static function createRouter(): RouteList {
        $router = new RouteList;
        $router[] = new Route('<presenter>/<Name>-<ID [0-9]+>[/stranka-<page [0-9]+>].html');

        $router[] = new Route('<presenter>/<action>', 'Homepage:default');
        return $router;
    }
}
