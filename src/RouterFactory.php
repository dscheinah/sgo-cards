<?php

namespace App;

use App\Handler\AchievementListHandler;
use App\Handler\CastleRankingHandler;
use App\Handler\CastleResultHandler;
use App\Handler\CastleTournamentHandler;
use App\Handler\HeroEnemyListHandler;
use App\Handler\HeroGetHandler;
use App\Handler\HeroListHandler;
use App\Handler\HeroModifierHandler;
use App\Handler\HeroSaveHandler;
use App\Handler\HeroShrineHandler;
use App\Handler\HeroSpecializationHandler;
use App\Handler\HeroStatHandler;
use App\Handler\HeroTrainingHandler;
use App\Handler\LeagueInformationHandler;
use App\Handler\LeagueListHandler;
use App\Handler\ListHandler;
use App\Handler\RoundLoadHandler;
use App\Handler\RoundNextHandler;
use App\Handler\TreasureActivateHandler;
use App\Handler\UserCreateHandler;
use App\Handler\UserGetHandler;
use App\Handler\UserLogoutHandler;
use App\Middleware\AchievementListMiddleware;
use App\Middleware\SpecializationMiddleware;
use App\Middleware\TournamentMiddleware;
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
     * @return Router
     */
    public function create(Injector $injector, array $options, string $class): Router
    {
        // The prefix can be set in the config if the index.php is not available from "/".
        $prefix = $options['prefix'] ?? '';
        $router = new Router($injector->get(MiddlewareHandlerInterface::class));
        // Add the example handler for the backend page.
        $router->post($prefix . 'list', ListHandler::class);

        $router->get($prefix . 'achievement/list', AchievementListMiddleware::class);
        $router->get($prefix . 'achievement/list', AchievementListHandler::class);

        $router->get($prefix . 'castle/ranking', CastleRankingHandler::class);
        $router->get($prefix . 'castle/result', CastleResultHandler::class);
        $router->get($prefix . 'castle/tournament', TournamentMiddleware::class);
        $router->get($prefix . 'castle/tournament', CastleTournamentHandler::class);

        $router->get($prefix . 'castle/hero/enemies', AchievementListMiddleware::class);
        $router->get($prefix . 'castle/hero/enemies', TournamentMiddleware::class);
        $router->get($prefix . 'castle/hero/enemies', HeroEnemyListHandler::class);
        $router->get($prefix . 'castle/hero/list', AchievementListMiddleware::class);
        $router->get($prefix . 'castle/hero/list', TournamentMiddleware::class);
        $router->get($prefix . 'castle/hero/list', HeroListHandler::class);
        $router->get($prefix . 'castle/hero/get', AchievementListMiddleware::class);
        $router->get($prefix . 'castle/hero/get', HeroGetHandler::class);
        $router->get($prefix . 'castle/hero/modifier', HeroModifierHandler::class);
        $router->post($prefix . 'castle/hero/stats', HeroStatHandler::class);
        $router->post($prefix . 'castle/hero/save', HeroSaveHandler::class);
        $router->get($prefix . 'castle/hero/shrine', HeroShrineHandler::class);
        $router->get($prefix . 'castle/hero/specialization', HeroSpecializationHandler::class);
        $router->get($prefix . 'castle/hero/training', AchievementListMiddleware::class);
        $router->get($prefix . 'castle/hero/training', TournamentMiddleware::class);
        $router->get($prefix . 'castle/hero/training', HeroTrainingHandler::class);

        $router->get($prefix . 'league/list', LeagueListHandler::class);
        $router->get($prefix . 'league/information', LeagueInformationHandler::class);

        $router->get($prefix . 'round/load', UserTokenCreateMiddleware::class);
        $router->get($prefix . 'round/load', RoundLoadHandler::class);

        $router->post($prefix . 'round/load', UserTokenCreateMiddleware::class);
        $router->post($prefix . 'round/load', SpecializationMiddleware::class);
        $router->post($prefix . 'round/load', RoundLoadHandler::class);

        $router->post($prefix . 'round/next', UserTokenValidateMiddleware::class);
        $router->post($prefix . 'round/next', RoundNextHandler::class);

        $router->post($prefix . 'treasure/activate', TreasureActivateHandler::class);

        $router->get($prefix . 'user/get', UserGetHandler::class);
        $router->post($prefix . 'user/create', UserCreateHandler::class);
        $router->get($prefix . 'user/logout', UserLogoutHandler::class);

        return $router;
    }
}
