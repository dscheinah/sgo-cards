<?php

namespace App\Handler;

use App\Repository\RoundRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Message\Response\ResponseHelperInterface;

class RoundNextHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly ResponseHelperInterface $helper,
        private readonly RoundRepository $roundRepository,
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
        $card = $request->getParsedBody()['card'] ?? null;
        if (!is_numeric($card)) {
            return $this->helper->create(400);
        }
        $result = $this->roundRepository->run($userId, $league, $card);
        if (!$result) {
            return $this->helper->create(500);
        }
        return $this->helper->create(200, $result);
    }
}
