<?php 

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {
    // Set the default route class to DashedRoute for cleaner URLs (e.g., /albums/index instead of /albums_index).
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        /*
         * This connects the root URL ('/') to the AlbumsController's 'index' action.
         * This means that when you visit the home page (http://localhost:8765/), 
         * the AlbumsController's 'index' method will be executed and the albums list will be displayed.
         */
        $builder->connect('/', ['controller' => 'Albums', 'action' => 'index']);

        /*
         * The fallback routes connect any unknown URLs to the corresponding controller and action.
         * It means that any other route not explicitly defined will be handled by the correct controller and action.
         */
        $builder->fallbacks();
    });
};
