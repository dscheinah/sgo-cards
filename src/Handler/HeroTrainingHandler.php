<?php

namespace App\Handler;

use App\Model\Tournament;
use App\Repository\HeroRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Message\Response\ResponseHelperInterface;

class HeroTrainingHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly ResponseHelperInterface $helper,
        private readonly HeroRepository $heroRepository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();

        $heroId = $queryParams['hero_id'] ?? null;
        $enemyId = $queryParams['enemy_id'] ?? null;
        if (!is_numeric($heroId) || !is_numeric($enemyId)) {
            return $this->helper->create(400);
        }

        $achievements = $request->getAttribute('achievements', []);
        $tournament = $request->getAttribute(Tournament::class);

        $result = $this->heroRepository->battle($achievements, $tournament, $heroId, $enemyId);
        if (!$result) {
            return $this->helper->create(500);
        }
        return $this->helper->create(200, $result);
    }
}
