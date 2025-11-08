<?php

namespace App\Handler;

use App\Repository\CastleRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Message\Response\ResponseHelperInterface;

class CastleTournamentHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly ResponseHelperInterface $helper,
        private readonly CastleRepository $castleRepository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->helper->create(200, $this->castleRepository->getNextTournament());
    }
}
