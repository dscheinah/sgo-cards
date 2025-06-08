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
use App\Helper\CardHelper;
use App\Helper\CardHelperFactory;
use App\Helper\ModifierHelper;
use App\Helper\ModifierHelperFactory;
use App\Helper\ShrineHelper;
use App\Helper\ShrineHelperFactory;
use App\Middleware\UserMiddlewareFactory;
use App\Middleware\UserTokenCreateMiddleware;
use App\Middleware\UserTokenValidateMiddleware;
use App\Provider\BattlefieldBuilder;
use App\Provider\BattlefieldBuilderFactory;
use App\Provider\BattleProvider;
use App\Provider\BattleProviderFactory;
use App\Provider\LeagueProvider;
use App\Provider\LeagueProviderFactory;
use App\Provider\PlayerProvider;
use App\Provider\PlayerProviderFactory;
use App\Provider\ShrineProvider;
use App\Provider\ShrineProviderFactory;
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
use App\Storage\ShrineStorage;
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

        $injector->set(CardHelper::class, CardHelperFactory::class);
        $injector->set(ModifierHelper::class, ModifierHelperFactory::class);
        $injector->set(ShrineHelper::class, ShrineHelperFactory::class);

        $injector->set(BattlefieldBuilder::class, BattlefieldBuilderFactory::class);
        $injector->set(BattleProvider::class, BattleProviderFactory::class);
        $injector->set(LeagueProvider::class, LeagueProviderFactory::class);
        $injector->set(PlayerProvider::class, PlayerProviderFactory::class);
        $injector->set(ShrineProvider::class, ShrineProviderFactory::class);

        $injector->set(LeagueRepository::class, LeagueRepositoryFactory::class);
        $injector->set(RoundRepository::class, RoundRepositoryFactory::class);
        $injector->set(UserRepository::class, UserRepositoryFactory::class);

        $injector->set(CardStorage::class, StorageFactory::class);
        $injector->set(LeagueStorage::class, StorageFactory::class);
        $injector->set(PlayerStorage::class, StorageFactory::class);
        $injector->set(ShrineStorage::class, StorageFactory::class);
        $injector->set(SnapshotStorage::class, StorageFactory::class);
        $injector->set(UserStorage::class, StorageFactory::class);
    }
}
