<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\TurboUser;
use App\Exception\SystemException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;

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

    public function updateUser(array $data): void
    {
        $this->createQueryBuilder('u')
            ->update()
            ->set('u.email', ':email')
            ->set('u.password', ':password')
            ->set('u.image', ':image')
            ->where('u.id = :id')
            ->setParameters([
                'id' => $data['id'],
                'email' => $data['email'],
                'password' => $data['password'],
                'image' => $data['image'],
            ])
            ->getQuery()
            ->execute();
    }

    public function updateUserStreakInARow(int $acutalId, int $id, int $streak)
    {
        if ($acutalId === $id)
        {
            $this->createQueryBuilder('u')
                ->update()
                ->set('u.highestStreak', ':highestStreak')
                ->where('u.id = :id')
                ->setParameters([
                    'id' => $id,
                    'highestStreak' => $streak
                ])
                ->getQuery()
                ->execute();
        }
        else
        {
            throw new SystemException('Du kannst nur deine Statistiken ändern.', Response::HTTP_UNAUTHORIZED);
        }
    }

    public function updateUserOverallStreak(int $acutalId, int $id, int $streak)
    {
        if ($acutalId === $id)
        {
            $this->createQueryBuilder('u')
                ->update()
                ->set('u.highestOverallStreak', ':highestOverallStreak')
                ->where('u.id = :id')
                ->setParameters([
                    'id' => $id,
                    'highestOverallStreak' => $streak
                ])
                ->getQuery()
                ->execute();
        }
        else
        {
            throw new SystemException('Du kannst nur deine Statistiken ändern.', Response::HTTP_UNAUTHORIZED);
        }
    }

    public function updatePlayedGames(int $acutalId, int $id, int $playedGames)
    {
        if ($acutalId === $id)
        {
            $this->createQueryBuilder('u')
                ->update()
                ->set('u.playedGames', ':playedGames')
                ->where('u.id = :id')
                ->setParameters([
                    'id' => $id,
                    'playedGames' => $playedGames
                ])
                ->getQuery()
                ->execute();
        }
        else
        {
            throw new SystemException('Du kannst nur deine Statistiken ändern.', Response::HTTP_UNAUTHORIZED);
        }
    }

    public function fetchSecret(int $id): string
    {
        return $this->createQueryBuilder('u')
            ->select('u.password')
            ->where('u.id = :id')
            ->setMaxResults(1)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
