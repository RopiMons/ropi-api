<?php

namespace App\Repository;

use App\Entity\PageStatique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PageStatique|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageStatique|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageStatique[]    findAll()
 * @method PageStatique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageStatiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageStatique::class);
    }

    // /**
    //  * @return PageStatique[] Returns an array of PageStatique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PageStatique
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
