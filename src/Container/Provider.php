<?php

namespace App\Container;

use App\ApplicationFactory;
use App\Handler\AchievementListHandler;
use App\Handler\AchievementListHandlerFactory;
use App\Handler\CastleHandlerFactory;
use App\Handler\CastleRankingHandler;
use App\Handler\CastleResultHandler;
use App\Handler\CastleTournamentHandler;
use App\Handler\HeroEnemyListHandler;
use App\Handler\HeroGetHandler;
use App\Handler\HeroHandlerFactory;
use App\Handler\HeroListHandler;
use App\Handler\HeroModifierHandler;
use App\Handler\HeroSaveHandler;
use App\Handler\HeroShrineHandler;
use App\Handler\HeroSpecializationHandler;
use App\Handler\HeroStatHandler;
use App\Handler\HeroTrainingHandler;
use App\Handler\LeagueHandlerFactory;
use App\Handler\LeagueInformationHandler;
use App\Handler\LeagueListHandler;
use App\Handler\ListHandler;
use App\Handler\ListHandlerFactory;
use App\Handler\RoundHandlerFactory;
use App\Handler\RoundLoadHandler;
use App\Handler\RoundNextHandler;
use App\Handler\TreasureActivateHandler;
use App\Handler\TreasureHandlerFactory;
use App\Handler\UserCreateHandler;
use App\Handler\UserGetHandler;
use App\Handler\UserHandlerFactory;
use App\Handler\UserLogoutHandler;
use App\Helper\AreaHelper;
use App\Helper\AreaHelperFactory;
use App\Helper\CardHelper;
use App\Helper\CardHelperFactory;
use App\Helper\ModifierHelper;
use App\Helper\ModifierHelperFactory;
use App\Helper\ShrineHelper;
use App\Helper\ShrineHelperFactory;
use App\Helper\SpecializationHelper;
use App\Helper\SpecializationHelperFactory;
use App\Helper\TreasureHelper;
use App\Helper\TreasureHelperFactory;
use App\Middleware\AchievementListMiddleware;
use App\Middleware\AchievementListMiddlewareFactory;
use App\Middleware\SpecializationMiddleware;
use App\Middleware\SpecializationMiddlewareFactory;
use App\Middleware\TournamentMiddleware;
use App\Middleware\TournamentMiddlewareFactory;
use App\Middleware\UserMiddlewareFactory;
use App\Middleware\UserTokenCreateMiddleware;
use App\Middleware\UserTokenValidateMiddleware;
use App\Provider\BattlefieldBuilder;
use App\Provider\BattlefieldBuilderFactory;
use App\Provider\BattleProvider;
use App\Provider\BattleProviderFactory;
use App\Provider\HeroBuilder;
use App\Provider\HeroBuilderFactory;
use App\Provider\LeagueProvider;
use App\Provider\LeagueProviderFactory;
use App\Provider\PlayerProvider;
use App\Provider\PlayerProviderFactory;
use App\Provider\ShrineProvider;
use App\Provider\ShrineProviderFactory;
use App\Provider\StatisticProvider;
use App\Provider\StatisticProviderFactory;
use App\Provider\TournamentProvider;
use App\Provider\TournamentProviderFactory;
use App\Provider\TreasureProvider;
use App\Provider\TreasureProviderFactory;
use App\Repository\AchievementRepository;
use App\Repository\AchievementRepositoryFactory;
use App\Repository\CastleRepository;
use App\Repository\CastleRepositoryFactory;
use App\Repository\HeroRepository;
use App\Repository\HeroRepositoryFactory;
use App\Repository\LeagueRepository;
use App\Repository\LeagueRepositoryFactory;
use App\Repository\RoundRepository;
use App\Repository\RoundRepositoryFactory;
use App\Repository\SpecializationRepository;
use App\Repository\SpecializationRepositoryFactory;
use App\Repository\TreasureRepository;
use App\Repository\TreasureRepositoryFactory;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryFactory;
use App\RouterFactory;
use App\Storage\CardStorage;
use App\Storage\HeroStorage;
use App\Storage\LeagueStorage;
use App\Storage\PlayerStorage;
use App\Storage\PoolStorage;
use App\Storage\RankingStorage;
use App\Storage\ResultStorage;
use App\Storage\ShrineStorage;
use App\Storage\SnapshotStorage;
use App\Storage\TournamentStorage;
use App\Storage\TreasureStorage;
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

        $injector->set(AchievementListHandler::class, AchievementListHandlerFactory::class);
        $injector->set(CastleRankingHandler::class, CastleHandlerFactory::class);
        $injector->set(CastleResultHandler::class, CastleHandlerFactory::class);
        $injector->set(CastleTournamentHandler::class, CastleHandlerFactory::class);
        $injector->set(HeroEnemyListHandler::class, HeroHandlerFactory::class);
        $injector->set(HeroGetHandler::class, HeroHandlerFactory::class);
        $injector->set(HeroListHandler::class, HeroHandlerFactory::class);
        $injector->set(HeroModifierHandler::class, HeroHandlerFactory::class);
        $injector->set(HeroSaveHandler::class, HeroHandlerFactory::class);
        $injector->set(HeroShrineHandler::class, HeroHandlerFactory::class);
        $injector->set(HeroSpecializationHandler::class, HeroHandlerFactory::class);
        $injector->set(HeroStatHandler::class, HeroHandlerFactory::class);
        $injector->set(HeroTrainingHandler::class, HeroHandlerFactory::class);
        $injector->set(LeagueListHandler::class, LeagueHandlerFactory::class);
        $injector->set(LeagueInformationHandler::class, LeagueHandlerFactory::class);
        $injector->set(RoundLoadHandler::class, RoundHandlerFactory::class);
        $injector->set(RoundNextHandler::class, RoundHandlerFactory::class);
        $injector->set(TreasureActivateHandler::class, TreasureHandlerFactory::class);
        $injector->set(UserGetHandler::class, UserHandlerFactory::class);
        $injector->set(UserCreateHandler::class, UserHandlerFactory::class);
        $injector->set(UserLogoutHandler::class, UserHandlerFactory::class);

        $injector->set(AchievementListMiddleware::class, AchievementListMiddlewareFactory::class);
        $injector->set(SpecializationMiddleware::class, SpecializationMiddlewareFactory::class);
        $injector->set(TournamentMiddleware::class, TournamentMiddlewareFactory::class);
        $injector->set(UserTokenCreateMiddleware::class, UserMiddlewareFactory::class);
        $injector->set(UserTokenValidateMiddleware::class, UserMiddlewareFactory::class);

        $injector->set(AreaHelper::class, AreaHelperFactory::class);
        $injector->set(CardHelper::class, CardHelperFactory::class);
        $injector->set(ModifierHelper::class, ModifierHelperFactory::class);
        $injector->set(ShrineHelper::class, ShrineHelperFactory::class);
        $injector->set(SpecializationHelper::class, SpecializationHelperFactory::class);
        $injector->set(TreasureHelper::class, TreasureHelperFactory::class);

        $injector->set(BattlefieldBuilder::class, BattlefieldBuilderFactory::class);
        $injector->set(BattleProvider::class, BattleProviderFactory::class);
        $injector->set(HeroBuilder::class, HeroBuilderFactory::class);
        $injector->set(LeagueProvider::class, LeagueProviderFactory::class);
        $injector->set(PlayerProvider::class, PlayerProviderFactory::class);
        $injector->set(ShrineProvider::class, ShrineProviderFactory::class);
        $injector->set(StatisticProvider::class, StatisticProviderFactory::class);
        $injector->set(TournamentProvider::class, TournamentProviderFactory::class);
        $injector->set(TreasureProvider::class, TreasureProviderFactory::class);

        $injector->set(AchievementRepository::class, AchievementRepositoryFactory::class);
        $injector->set(CastleRepository::class, CastleRepositoryFactory::class);
        $injector->set(HeroRepository::class, HeroRepositoryFactory::class);
        $injector->set(LeagueRepository::class, LeagueRepositoryFactory::class);
        $injector->set(RoundRepository::class, RoundRepositoryFactory::class);
        $injector->set(SpecializationRepository::class, SpecializationRepositoryFactory::class);
        $injector->set(TreasureRepository::class, TreasureRepositoryFactory::class);
        $injector->set(UserRepository::class, UserRepositoryFactory::class);

        $injector->set(CardStorage::class, StorageFactory::class);
        $injector->set(HeroStorage::class, StorageFactory::class);
        $injector->set(LeagueStorage::class, StorageFactory::class);
        $injector->set(PlayerStorage::class, StorageFactory::class);
        $injector->set(PoolStorage::class, StorageFactory::class);
        $injector->set(RankingStorage::class, StorageFactory::class);
        $injector->set(ResultStorage::class, StorageFactory::class);
        $injector->set(ShrineStorage::class, StorageFactory::class);
        $injector->set(SnapshotStorage::class, StorageFactory::class);
        $injector->set(TournamentStorage::class, StorageFactory::class);
        $injector->set(TreasureStorage::class, StorageFactory::class);
        $injector->set(UserStorage::class, StorageFactory::class);
    }
}
