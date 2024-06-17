<?php

namespace App\Handler;

use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Message\Response\ResponseHelperInterface;

class UserCreateHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly ResponseHelperInterface $helper,
        private readonly UserRepository $userRepository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $name = $request->getParsedBody()['name'] ?? null;
        if (!$name) {
            return $this->helper->create(400);
        }
        $user = $this->userRepository->create($name);
        if (!$user) {
            return $this->helper->create(500);
        }
        return $this->helper->create(200, $user);
    }
}
