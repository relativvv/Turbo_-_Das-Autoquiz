<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    #[Route("/quiz", "api.question")]
    public function loadQuestion(): JsonResponse
    {
        return new JsonResponse();
    }

    #[Route("/quiz/{id}", "api.answer")]
    public function setAnswer(): JsonResponse
    {
        return new JsonResponse();
    }
}