<?php

namespace App\Service;

use App\Entity\TurboQuestion;
use App\Repository\TurboQuestionRepository;

class QuestionService
{

    public function __construct(
        private readonly TurboQuestionRepository $questionRepository
    ){}

    public function getQuestionPerDifficulty(string $difficulty): string|array|int
    {
        $question = $this->questionRepository->findBy(['difficulty' => $difficulty]);

        return array_rand($question);
    }

    public function getQuestionPerCategory(string $category): array|int|string
    {
        $question = $this->questionRepository->findBy(['category' => $category]);

        return array_rand($question);
    }

    public function checkQuestion($data): ?TurboQuestion
    {
        $question = $this->questionRepository->findOneBy(['id'], $data['id']);

        $answer = $data['answer'];

        if ($question->getCorrectAnswer() == $answer)
        {
            return $question;
        }

        return null;
    }
}