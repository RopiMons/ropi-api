<?php

namespace App\Repository;

use App\Entity\Adresse;
use App\Entity\Commerce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commerce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commerce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commerce[]    findAll()
 * @method Commerce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommerceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commerce::class);
    }

    public function getCommerces(?int $id = null){
        $queryBuilder = $this
            ->createQueryBuilder('commerces')
            ->select(['commerces','adresses','pays','ville','liens'])
            ->leftJoin('commerces.adresses','adresses')
            ->join('adresses.pays','pays')
            ->join('adresses.ville','ville')
            ->leftJoin('commerces.liens','liens')
            ->where('commerces.visible = :true')
            ->andWhere('adresses.actif = :true')
            ->andWhere('liens.isSuspicious = :false')
            ->andWhere('adresses.typeAdresse = :commerce')
            ->setParameter('true',true)
            ->setParameter('false',false)
            ->setParameter('commerce',Adresse::COMMERCE)
        ;

        if(null!==$id){
            try {
                return $queryBuilder
                    ->andWhere('commerces.id = :id')
                    ->setParameter('id', $id)
                    ->getQuery()
                    ->getSingleResult();
            }catch (\Exception $e){
                return null;
            }
        }

        return $queryBuilder->getQuery()->execute();
    }

    // /**
    //  * @return Commerce[] Returns an array of Commerce objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commerce
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
