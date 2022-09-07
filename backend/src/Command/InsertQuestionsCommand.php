<?php

namespace App\Command;

use App\Entity\TurboQuestion;
use App\Repository\TurboQuestionRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InsertQuestionsCommand extends Command
{
    public function __construct(private readonly TurboQuestionRepository $questionRepository)
    {
        parent::__construct();
    }

    private function createQuestion(
        string $stringQuestion,
        string $difficulty,
        string $category,
        string $firstWrongAnswer,
        string $secondWrongAnswer,
        string $thirdWrongAnswer,
        string $correctAnswer
    ): TurboQuestion
    {
        $question = new TurboQuestion();
        $question->setQuestion($stringQuestion);
        $question->setDifficulty($difficulty);
        $question->setCategory($category);
        $question->setFirstWrongAnswer($firstWrongAnswer);
        $question->setSecondWrongAnswer($secondWrongAnswer);
        $question->setThirdWrongAnswer($thirdWrongAnswer);
        $question->setCorrectAnswer($correctAnswer);

        return $question;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $question = $this->createQuestion(
            'Woran wird Hubraum gemessen?',
            'leicht',
            'Motor',
            'Kraft',
            'Masse',
            'Gewicht',
            'Volumen');
        $this->questionRepository->createQuestion($question);

        
    }
}