<?php

namespace App\Handler;

use App\Model\Tournament;
use App\Repository\HeroRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Message\Response\ResponseHelperInterface;

class HeroEnemyListHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly ResponseHelperInterface $helper,
        private readonly HeroRepository $heroRepository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $achievements = $request->getAttribute('achievements', []);
        $tournament = $request->getAttribute(Tournament::class);
        return $this->helper->create(200, $this->heroRepository->getRandomEnemies($achievements, $tournament));
    }
}
