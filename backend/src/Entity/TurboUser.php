<?php

namespace App\Entity;

use App\Repository\TurboUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TurboUserRepository::class)]
class TurboUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(nullable: true)]
    private ?int $highestStreak = null;

    #[ORM\Column(nullable: true)]
    private ?int $highestOverallStreak = null;

    #[ORM\Column(nullable: true)]
    private ?int $playedGames = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getHighestStreak(): ?int
    {
        return $this->highestStreak;
    }

    public function setHighestStreak(?int $highestStreak): self
    {
        $this->highestStreak = $highestStreak;

        return $this;
    }

    public function getHighestOverallStreak(): ?int
    {
        return $this->highestOverallStreak;
    }

    public function setHighestOverallStreak(?int $highestOverallStreak): self
    {
        $this->highestOverallStreak = $highestOverallStreak;

        return $this;
    }

    public function getPlayedGames(): ?int
    {
        return $this->playedGames;
    }

    public function setPlayedGames(?int $playedGames): self
    {
        $this->playedGames = $playedGames;

        return $this;
    }
}
