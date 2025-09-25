<?php

namespace App\Handler;

use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Message\Response\ResponseHelperInterface;

class UserLogoutHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly ResponseHelperInterface $helper,
        private readonly UserRepository $userRepository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $userId = $request->getQueryParams()['user_id'] ?? null;
        if (!$userId) {
            return $this->helper->create(400);
        }
        $this->userRepository->logout($userId);
        return $this->helper->create(204);
    }
}
