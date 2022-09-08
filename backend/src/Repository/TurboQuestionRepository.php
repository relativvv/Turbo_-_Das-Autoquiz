<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\TurboQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TurboQuestionRepository extends ServiceEntityRepository
{
    public function __construct(private readonly ManagerRegistry $registry)
    {
        parent::__construct($registry, TurboQuestion::class);
    }

    public function add(TurboQuestion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TurboQuestion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function createQuestion(TurboQuestion $question): void
    {
        $entityManager = $this->registry->getManager();
        $entityManager->persist($question);
    }
}
