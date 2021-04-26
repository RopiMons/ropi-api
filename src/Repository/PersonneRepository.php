<?php

namespace App\Repository;

use App\Entity\Personne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Personne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personne[]    findAll()
 * @method Personne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personne::class);
    }

    public function getIfExist($nomPrenom): ?Personne
    {
        $qb = $this->createQueryBuilder('personne');

        try {
            return $qb
                ->select(['personne', 'adresses', 'pays', 'ville', 'commerces', 'contacts', 'type_contact', 'commandes'])
                ->leftJoin('personne.adresses', 'adresses')
                ->leftJoin('adresses.pays', 'pays')
                ->leftJoin('adresses.ville', 'ville')
                ->leftJoin('personne.commerces', 'commerces')
                ->leftJoin('personne.contacts', 'contacts')
                ->leftJoin('contacts.typeContact', 'type_contact')
                ->leftJoin('personne.commandes', 'commandes')
                ->where($qb->expr()->upper('personne.prenom') . " = :prenom ")
                ->orWhere($qb->expr()->upper('personne.nom') . " = :prenom ")
                ->orWhere($qb->expr()->upper("CONCAT(personne.prenom,' ', personne.nom)") . " = :prenom ")
                ->orWhere($qb->expr()->upper("CONCAT(personne.nom,' ', personne.prenom)") . " = :prenom ")
                ->setParameter('prenom', strtoupper($nomPrenom))
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException | NonUniqueResultException $e) {
            return null;
        }
    }


    // /**
    //  * @return Personne[] Returns an array of Personne objects
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
    public function findOneBySomeField($value): ?Personne
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
