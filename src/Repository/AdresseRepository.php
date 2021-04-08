<?php

namespace App\Repository;

use App\Entity\Adresse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Adresse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adresse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adresse[]    findAll()
 * @method Adresse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdresseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adresse::class);
    }

    /**
     * @param int $id
     * @return Adresse|null
     */
    public function getApiAddresse(int $id) : ?Adresse {
        try {
            return $this
                ->createQueryBuilder('adresse')
                ->select(['adresse','pays','ville','commerce'])
                ->leftJoin('adresse.pays','pays')
                ->leftJoin('adresse.ville','ville')
                ->join('adresse.commerce','commerce')
                ->where('adresse.id = :id')
                ->andWhere('adresse.actif = :true')
                ->andWhere('adresse.typeAdresse = :type')
                ->andWhere('commerce.visible = :true')
                ->setParameters([
                    'id' => $id,
                    'true' => true,
                    'type' => Adresse::COMMERCE
                ])
                ->getQuery()
                ->getSingleResult()
                ;
        }catch (\Exception $exception){
            return null;
        }
    }

    // /**
    //  * @return Adresse[] Returns an array of Adresse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Adresse
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
