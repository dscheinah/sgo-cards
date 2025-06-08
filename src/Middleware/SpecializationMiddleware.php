<?php

namespace App\Middleware;

use App\Repository\SpecializationRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Message\Response\ResponseHelperInterface;

class SpecializationMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly ResponseHelperInterface $helper,
        private readonly SpecializationRepository $specializationRepository,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $userId = $request->getQueryParams()['user_id'] ?? null;
        if (!$userId) {
            return $this->helper->create(400);
        }
        $league = $request->getParsedBody()['league'] ?? null;
        if (!is_numeric($league)) {
            return $this->helper->create(400);
        }
        $this->specializationRepository->update($userId, $league, $request->getParsedBody()['identifier'] ?? null);
        return $handler->handle($request);
    }
}
