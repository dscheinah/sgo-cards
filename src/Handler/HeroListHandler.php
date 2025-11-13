<?php

namespace App\Handler;

use App\Repository\HeroRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Message\Response\ResponseHelperInterface;

class HeroListHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly ResponseHelperInterface $helper,
        private readonly HeroRepository $heroRepository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $userId = $request->getQueryParams()['user_id'] ?? null;
        if (!$userId) {
            return $this->helper->create(400);
        }
        $achievements = $request->getAttribute('achievements', []);
        $heroId = $request->getQueryParams()['hero_id'] ?? null;
        return $this->helper->create(200, $this->heroRepository->getListForUser($userId, $achievements, $heroId));
    }
}
