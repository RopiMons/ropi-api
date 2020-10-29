<?php

namespace App\Repository;

use App\Entity\Paragraphe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Paragraphe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paragraphe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paragraphe[]    findAll()
 * @method Paragraphe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParagrapheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paragraphe::class);
    }

    // /**
    //  * @return Paragraphe[] Returns an array of Paragraphe objects
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
    public function findOneBySomeField($value): ?Paragraphe
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
