<?php

namespace App;

use App\Handler\LeagueInformationHandler;
use App\Handler\LeagueListHandler;
use App\Handler\ListHandler;
use App\Handler\RoundLoadHandler;
use App\Handler\RoundNextHandler;
use App\Handler\UserCreateHandler;
use App\Handler\UserGetHandler;
use App\Middleware\SpecializationMiddleware;
use App\Middleware\UserTokenCreateMiddleware;
use App\Middleware\UserTokenValidateMiddleware;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;
use Sx\Server\MiddlewareHandlerInterface;
use Sx\Server\Router;

/**
 * The factory for the router. It defines all available routes.
 */
class RouterFactory implements FactoryInterface
{
    /**
     * Creates the router and registers all handlers for routes.
     *
     * @param Injector $injector
     * @param array    $options
     * @param string   $class
     *
     * @return mixed|Router
     */
    public function create(Injector $injector, array $options, string $class): Router
    {
        // The prefix can be set in the config if the index.php is not available from "/".
        $prefix = $options['prefix'] ?? '';
        $router = new Router($injector->get(MiddlewareHandlerInterface::class));
        // Add the example handler for the backend page.
        $router->post($prefix . 'list', ListHandler::class);

        $router->get($prefix . 'league/list', LeagueListHandler::class);
        $router->get($prefix . 'league/information', LeagueInformationHandler::class);

        $router->get($prefix . 'round/load', UserTokenCreateMiddleware::class);
        $router->get($prefix . 'round/load', RoundLoadHandler::class);

        $router->post($prefix . 'round/load', UserTokenCreateMiddleware::class);
        $router->post($prefix . 'round/load', SpecializationMiddleware::class);
        $router->post($prefix . 'round/load', RoundLoadHandler::class);

        $router->post($prefix . 'round/next', UserTokenValidateMiddleware::class);
        $router->post($prefix . 'round/next', RoundNextHandler::class);

        $router->get($prefix . 'user/get', UserGetHandler::class);
        $router->post($prefix . 'user/create', UserCreateHandler::class);

        return $router;
    }
}
