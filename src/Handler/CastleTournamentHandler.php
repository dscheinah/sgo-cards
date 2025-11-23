<?php

namespace App\Handler;

use App\Model\Tournament;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Message\Response\ResponseHelperInterface;

class CastleTournamentHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly ResponseHelperInterface $helper,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $tournament = $request->getAttribute(Tournament::class);
        if (!$tournament instanceof Tournament) {
            return $this->helper->create(200);
        }
        return $this->helper->create(200, $tournament->output());
    }
}
