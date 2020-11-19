<?php

namespace App\Repository;

use App\Entity\LanguageCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LanguageCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method LanguageCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method LanguageCategory[]    findAll()
 * @method LanguageCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LanguageCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LanguageCategory::class);
    }

    // /**
    //  * @return LanguageCategory[] Returns an array of LanguageCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LanguageCategory
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
