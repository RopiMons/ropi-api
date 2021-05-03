<?php

namespace App\Repository;

use App\Entity\Commande;
use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    /**
     * @param int $personneId
     * @param int $contactId
     * @return Commande|null
     */
    public function getMailOf(int $personneId, int $contactId): ?Contact
    {
        try {
            return $this
                ->createQueryBuilder('contact')
                ->join('contact.personnes', 'personnes', Join::WITH, 'personnes.actif = :true')
                ->join('contact.typeContact', 'type_contact', Join::WITH, 'type_contact.type = :emailType')
                ->where('personnes.id = :personneId')
                ->andWhere('contact.id = :contactId')
                ->setParameters([
                    'true' => true,
                    'emailType' => 'Email',
                    'personneId' => $personneId,
                    'contactId' => $contactId
                ])
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException | NonUniqueResultException $e) {
            return null;
        }

    }

    // /**
    //  * @return Contact[] Returns an array of Contact objects
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
    public function findOneBySomeField($value): ?Contact
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
