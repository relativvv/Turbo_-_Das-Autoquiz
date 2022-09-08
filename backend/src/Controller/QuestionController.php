<?php

namespace App\Controller;

use App\Entity\TurboQuestion;
use App\Service\QuestionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    public function __construct(private readonly QuestionService $questionService) { }


    /**
     * @Route("/api/get/question/difficulty/{difficulty}", name="api.question.difficulty", methods={"GET"})
     */
    public function getQuestionPerDifficulty(string $difficulty): JsonResponse
    {
        return new JsonResponse($this->questionService->getQuestionPerDifficulty($difficulty)->toArrayWithoutCorrectAnswer());
    }

    /**
     * @Route("/api/get/question/category/{category}", name="api.question.category", methods={"GET"})
     */
    public function getQuestionPerCategory(string $category): JsonResponse
    {
        return new JsonResponse($this->questionService->getQuestionPerCategory($category)->toArrayWithoutCorrectAnswer());
    }

    /**
     * @Route("/api/check/question", name="api.question.check", methods={"POST"})
     */
    public function checkQuestion(Request $request): JsonResponse
    {
        $data = $request->request->all();

        return new JsonResponse($this->questionService->checkQuestion($data)->toArrayWithCorrectAnswer());
    }
}
