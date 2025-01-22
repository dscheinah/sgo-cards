<?php

namespace App\Container;

use App\ApplicationFactory;
use App\Handler\LeagueHandlerFactory;
use App\Handler\LeagueInformationHandler;
use App\Handler\LeagueListHandler;
use App\Handler\ListHandler;
use App\Handler\ListHandlerFactory;
use App\Handler\RoundHandlerFactory;
use App\Handler\RoundLoadHandler;
use App\Handler\RoundNextHandler;
use App\Handler\UserCreateHandler;
use App\Handler\UserGetHandler;
use App\Handler\UserHandlerFactory;
use App\Helper\Battle;
use App\Helper\BattleFactory;
use App\Helper\Card;
use App\Helper\CardFactory;
use App\Helper\Modifier;
use App\Helper\ModifierFactory;
use App\Helper\Player;
use App\Helper\PlayerFactory;
use App\Middleware\UserMiddlewareFactory;
use App\Middleware\UserTokenValidateMiddleware;
use App\Middleware\UserTokenCreateMiddleware;
use App\Repository\LeagueRepository;
use App\Repository\LeagueRepositoryFactory;
use App\Repository\RoundRepository;
use App\Repository\RoundRepositoryFactory;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryFactory;
use App\RouterFactory;
use App\Storage\CardStorage;
use App\Storage\LeagueStorage;
use App\Storage\PlayerStorage;
use App\Storage\SnapshotStorage;
use App\Storage\UserStorage;
use Sx\Application\Container\ApplicationProvider;
use Sx\Container\Injector;
use Sx\Container\ProviderInterface;
use Sx\Data\Backend\MySqlBackendFactory;
use Sx\Data\BackendInterface;
use Sx\Data\StorageFactory;
use Sx\Log\Container\LogProvider;
use Sx\Message\Container\MessageProvider;
use Sx\Server\ApplicationInterface;
use Sx\Server\Container\ServerProvider;
use Sx\Server\RouterInterface;

/**
 * This class is used in index.php to setup the dependency injector.
 */
class Provider implements ProviderInterface
{
    /**
     * Adds all used mappings for interfaces and classes to factories.
     *
     * @param Injector $injector
     */
    public function provide(Injector $injector): void
    {
        // First do a setup of all modules installed by composer.
        $injector->setup(new ApplicationProvider());
        $injector->setup(new LogProvider());
        $injector->setup(new MessageProvider());
        $injector->setup(new ServerProvider());
        // Add all local classes and factories.
        $injector->set(ApplicationInterface::class, ApplicationFactory::class);
        $injector->set(RouterInterface::class, RouterFactory::class);
        $injector->set(ListHandler::class, ListHandlerFactory::class);

        $injector->set(BackendInterface::class, MySqlBackendFactory::class);

        $injector->set(LeagueListHandler::class, LeagueHandlerFactory::class);
        $injector->set(LeagueInformationHandler::class, LeagueHandlerFactory::class);
        $injector->set(RoundLoadHandler::class, RoundHandlerFactory::class);
        $injector->set(RoundNextHandler::class, RoundHandlerFactory::class);
        $injector->set(UserGetHandler::class, UserHandlerFactory::class);
        $injector->set(UserCreateHandler::class, UserHandlerFactory::class);

        $injector->set(UserTokenCreateMiddleware::class, UserMiddlewareFactory::class);
        $injector->set(UserTokenValidateMiddleware::class, UserMiddlewareFactory::class);

        $injector->set(Battle::class, BattleFactory::class);
        $injector->set(Card::class, CardFactory::class);
        $injector->set(Modifier::class, ModifierFactory::class);
        $injector->set(Player::class, PlayerFactory::class);

        $injector->set(LeagueRepository::class, LeagueRepositoryFactory::class);
        $injector->set(RoundRepository::class, RoundRepositoryFactory::class);
        $injector->set(UserRepository::class, UserRepositoryFactory::class);

        $injector->set(CardStorage::class, StorageFactory::class);
        $injector->set(LeagueStorage::class, StorageFactory::class);
        $injector->set(PlayerStorage::class, StorageFactory::class);
        $injector->set(SnapshotStorage::class, StorageFactory::class);
        $injector->set(UserStorage::class, StorageFactory::class);
    }
}
