<?php

namespace App\Router;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\Utils\Strings;

class RouterFactory {
    use Nette\StaticClass;

    /**
     * @return Nette\Application\IRouter
     */
    public static function createRouter() {
        $router = new RouteList;
        $router[] = new Route('<presenter>/<Name>-<ID [0-9]+>[/stranka-<page [0-9]+>].html', [
            NULL  => [
                Route::FILTER_OUT => function(array $params) {
                    if (!empty($params['Name'])) {
                        $params['Name'] = Strings::webalize($params['Name']);
                    }
                    return $params;
                }
            ],
            'presenter' => [
                Route::VALUE => 'Homepage',
                Route::FILTER_TABLE => [
                    'kategoria' => 'Category',
                    'clanok' => 'Article',
                    'diskusia' => 'Discussion',
                ],
            ],
            'action' => 'default',
        ]);

        $router[] = new Route('<presenter>/<action>', 'Homepage:default');
        return $router;
    }
}
