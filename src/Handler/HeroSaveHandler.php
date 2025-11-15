<?php

namespace App\Handler;

use App\Repository\HeroRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Message\Response\ResponseHelperInterface;

class HeroSaveHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly ResponseHelperInterface $helper,
        private readonly HeroRepository $heroRepository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $userId = $request->getQueryParams()['user_id'] ?? null;
        if (!$userId) {
            return $this->helper->create(400);
        }

        $data = (array) $request->getParsedBody();
        if (!($data['name'] ?? '')) {
            return $this->helper->create(400);
        }
        if (!isset($data['cards']) || !is_array($data['cards'])) {
            return $this->helper->create(400);
        }

        $heroId = $request->getQueryParams()['hero_id'] ?? null;

        if (!$this->heroRepository->save($userId, $data, $heroId)) {
            return $this->helper->create(500);
        }
        return $this->helper->create(200);
    }
}
