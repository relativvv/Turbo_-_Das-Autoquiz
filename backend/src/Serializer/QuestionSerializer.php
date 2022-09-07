<?php

namespace App\Serializer;

use App\Entity\TurboQuestion;

class QuestionSerializer
{
    public function deserialize(array $givenQuestion): TurboQuestion
    {
        $question = new TurboQuestion();
        $question->setQuestion($givenQuestion['question']);
        $question->setCategory($givenQuestion['category']);
        $question->setDifficulty($givenQuestion['difficulty']);
        $question->setFirstWrongAnswer($givenQuestion['firstWrongAnswer']);
        $question->setSecondWrongAnswer($givenQuestion['secondWrongAnswer']);
        $question->setThirdWrongAnswer($givenQuestion['thirdWrongAnswer']);
        $question->setCorrectAnswer($givenQuestion['correctAnswer']);

        return $question;
    }
}