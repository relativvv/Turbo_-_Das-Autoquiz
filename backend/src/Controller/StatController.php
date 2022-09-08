<?php

namespace App\Controller;

use App\Service\AuthenticationService;
use App\Service\StatService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class StatController extends AbstractController
{
    public function __construct(private readonly StatService $statService, private readonly AuthenticationService $authService) { }

    /**
     * @Route("/api/put/stat/id/{id}/streakInRow/{streakInRow}", name="api.stat.streakInRow", methods={"PUT"})
     */
    public function setHighestStreakInRow(int $id, int $streak): JsonResponse
    {
        $this->authService->isAuthorized();
        return new JsonResponse($this->statService->setHighestStreakInRow($id, $streak));
    }

    /**
     * @Route("/api/put/stat/id/{id}/overallStreak/{overallStreak}", name="api.stat.overallStreak", methods={"PUT"})
     */
    public function setHighestOverallStreak(int $id, int $streak): JsonResponse
    {
        $this->authService->isAuthorized();
        return new JsonResponse($this->statService->setHighestOverallStreak($id, $streak));
    }

    /**
     * @Route("/api/put/stat/id/{id}/playedGames/{playedGames}", name="api.stat.playedGames", methods={"PUT"})
     */
    public function setPlayedGames(int $id, int $playedGames): JsonResponse
    {
        $this->authService->isAuthorized();
        return new JsonResponse($this->statService->setPlayedGames($id, $playedGames));
    }
}