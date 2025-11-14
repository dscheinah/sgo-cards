<?php

namespace App\Middleware;

use App\Model\Tournament;
use App\Provider\TournamentProvider;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TournamentMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly TournamentProvider $tournamentProvider,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $handler->handle($request->withAttribute(Tournament::class, $this->tournamentProvider->next()));
    }
}
