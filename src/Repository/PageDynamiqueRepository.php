<?php

namespace App\Repository;

use App\Entity\PageDynamique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PageDynamique|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageDynamique|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageDynamique[]    findAll()
 * @method PageDynamique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageDynamiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageDynamique::class);
    }

    // /**
    //  * @return PageDynamique[] Returns an array of PageDynamique objects
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
    public function findOneBySomeField($value): ?PageDynamique
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
