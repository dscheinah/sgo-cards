<?php

namespace App\Middleware;

use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Message\Response\ResponseHelperInterface;

class UserTokenValidateMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly ResponseHelperInterface $helper,
        private readonly UserRepository $userRepository,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $userId = $request->getQueryParams()['user_id'] ?? null;
        if (!$userId) {
            return $this->helper->create(400);
        }
        $token = $request->getParsedBody()['token'] ?? null;
        if (!$token || !$this->userRepository->validateToken($userId, $token)) {
            return $this->helper->create(400);
        }
        return $handler->handle($request);
    }
}
