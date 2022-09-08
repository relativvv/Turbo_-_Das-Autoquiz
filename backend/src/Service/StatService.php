<?php

namespace App\Service;

use App\Repository\TurboUserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class StatService
{
    public function __construct(private readonly TurboUserRepository $userRepository, private readonly AuthenticationService $authService){}

    public function setHighestStreakInRow(int $id, int $streak): JsonResponse
    {
        $acutalId = $this->authService->getIdentity()->getId();
        $this->userRepository->updateUserStreakInARow($acutalId, $id, $streak);

        return new JsonResponse($this->userRepository->findOneBy(['id' => $id]));
    }

    public function setHighestOverallStreak(int $id, int $streak): JsonResponse
    {
        $acutalId = $this->authService->getIdentity()->getId();
        $this->userRepository->updateUserOverallStreak($acutalId, $id, $streak);

        return new JsonResponse($this->userRepository->findOneBy(['id' => $id]));
    }

    public function setPlayedGames(int $id, int $playedGames): JsonResponse
    {
        $acutalId = $this->authService->getIdentity()->getId();
        $this->userRepository->updatePlayedGames($acutalId, $id, $playedGames);

        return new JsonResponse($this->userRepository->findOneBy(['id' => $id]));
    }

}