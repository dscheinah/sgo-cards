<?php

namespace App\Middleware;

use App\Repository\AchievementRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Message\Response\ResponseHelperInterface;

class AchievementListMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly ResponseHelperInterface $helper,
        private readonly AchievementRepository $achievementRepository,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $userId = $request->getQueryParams()['user_id'] ?? null;
        if (!$userId) {
            return $this->helper->create(400);
        }
        return $handler->handle(
            $request->withAttribute('achievements', $this->achievementRepository->getList($userId))
        );
    }
}
