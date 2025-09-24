<?php

namespace App\Handler;

use App\Repository\TreasureRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Message\Response\ResponseHelperInterface;

class TreasureActivateHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly ResponseHelperInterface $helper,
        private readonly TreasureRepository $treasureRepository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $userId = $request->getQueryParams()['user_id'] ?? null;
        if (!$userId) {
            return $this->helper->create(400);
        }
        $league = $request->getParsedBody()['league'] ?? null;
        if (!is_numeric($league)) {
            return $this->helper->create(400);
        }
        $this->treasureRepository->activate($userId, $league, $request->getParsedBody()['ids'] ?? []);
        return $this->helper->create(204);
    }
}
