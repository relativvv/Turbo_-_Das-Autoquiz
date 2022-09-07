<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\TurboUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TurboUser>
 *
 * @method TurboUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method TurboUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method TurboUser[]    findAll()
 * @method TurboUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TurboUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TurboUser::class);
    }

    public function add(TurboUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TurboUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByIdentity(string $identity): ?TurboUser
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :identity OR u.email = :identity')
            ->setParameters([
                'identity' => $identity,
            ])
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function userExist(string $username, string $email): bool
    {
        return $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->where('u.username = :username OR u.email = :email')
            ->setParameters([
                 'username' => $username,
                 'email' => $email,
            ])
            ->getQuery()
            ->getSingleScalarResult() > 0;
    }
}
