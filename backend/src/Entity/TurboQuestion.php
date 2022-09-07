<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\TurboQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TurboQuestionRepository::class)]
class TurboQuestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $question = null;

    #[ORM\Column(length: 255)]
    private ?string $correctAnswer = null;

    #[ORM\Column(length: 255)]
    private ?string $firstWrongAnswer = null;

    #[ORM\Column(length: 255)]
    private ?string $secondWrongAnswer = null;

    #[ORM\Column(length: 255)]
    private ?string $thirdWrongAnswer = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column]
    private ?int $difficulty = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getCorrectAnswer(): ?string
    {
        return $this->correctAnswer;
    }

    public function setCorrectAnswer(string $correctAnswer): self
    {
        $this->correctAnswer = $correctAnswer;

        return $this;
    }

    public function getFirstWrongAnswer(): ?string
    {
        return $this->firstWrongAnswer;
    }

    public function setFirstWrongAnswer(string $firstWrongAnswer): self
    {
        $this->firstWrongAnswer = $firstWrongAnswer;

        return $this;
    }

    public function getSecondWrongAnswer(): ?string
    {
        return $this->secondWrongAnswer;
    }

    public function setSecondWrongAnswer(string $secondWrongAnswer): self
    {
        $this->secondWrongAnswer = $secondWrongAnswer;

        return $this;
    }

    public function getThirdWrongAnswer(): ?string
    {
        return $this->thirdWrongAnswer;
    }

    public function setThirdWrongAnswer(string $thirdWrongAnswer): self
    {
        $this->thirdWrongAnswer = $thirdWrongAnswer;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }
}
