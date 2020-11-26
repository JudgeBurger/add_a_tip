<?php

namespace App\Repository;

use App\Entity\Tips;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Tips|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tips|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tips[]    findAll()
 * @method Tips[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tips::class);
    }

    public function lastTips()
    {
        $qb = $this->createQueryBuilder('t')
            ->orderBy('t.createdAt', 'DESC')
            ->setMaxResults('3');

        $query = $qb->getQuery();

        return $query->getResult();
    }

    // /**
    //  * @return Tips[] Returns an array of Tips objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tips
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
