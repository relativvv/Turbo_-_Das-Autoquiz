<?php

namespace App\Controller;

use App\Entity\TurboQuestion;
use App\Service\QuestionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class QuestionController extends AbstractController
{
    public function __construct(private readonly QuestionService $questionService)
    {}

    public function getQuestionPerDifficulty(string $difficulty): array|int|string
    {
        return new JsonResponse($this->questionService->getQuestionPerDifficulty($difficulty));
    }

    public function getQuestionPerCategory(string $category): array|int|string
    {
        return new JsonResponse($this->questionService->getQuestionPerCategory($category));
    }

    public function checkQuestion(Request $request): ?TurboQuestion
    {
        $data = $request->request->all();

        return $this->questionService->checkQuestion($data);
    }
}
