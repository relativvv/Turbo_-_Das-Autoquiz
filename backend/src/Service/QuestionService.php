<?php

namespace App\Service;

use App\Entity\TurboQuestion;
use App\Repository\TurboQuestionRepository;

class QuestionService
{

    public function __construct(
        private readonly TurboQuestionRepository $questionRepository
    ){}

    public function getQuestionPerDifficulty(string $difficulty): TurboQuestion
    {
        $questions = $this->questionRepository->findBy(['difficulty' => $difficulty]);

        return $questions[array_rand($questions)];
    }

    public function getQuestionPerCategory(string $category): TurboQuestion
    {
        $questions = $this->questionRepository->findBy(['category' => $category]);

        return $questions[array_rand($questions)];
    }

    public function checkQuestion($data): TurboQuestion
    {
        $question = $this->questionRepository->findOneBy(['id' => $data['id']]);

        return $question;
    }
}
