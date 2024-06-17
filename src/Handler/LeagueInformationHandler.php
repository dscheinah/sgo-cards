<?php

namespace App\Handler;

use App\Repository\LeagueRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Message\Response\ResponseHelperInterface;

class LeagueInformationHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly ResponseHelperInterface $helper,
        private readonly LeagueRepository $leagueRepository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getQueryParams()['id'] ?? null;
        if (!$id) {
            return $this->helper->create(400);
        }
        $information = $this->leagueRepository->getInformation($id);
        if (!$information) {
            return $this->helper->create(404);
        }
        return $this->helper->create(200, $information);
    }
}
