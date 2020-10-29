<?php

namespace App\Repository;

use App\Entity\PageStatique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
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

    /**
     * @param int $idPage
     * @return null|PageStatique
     */
    public function getCompletePage(int $idPage) : ?PageStatique{
        try {
            return $this
                ->createQueryBuilder('page')
                ->select(['page', 'paragraphes'])
                ->leftJoin('page.paragraphes', 'paragraphes')
                ->orderBy('paragraphes.position', 'ASC')
                ->where('page.id = :pageId')
                ->setParameter('pageId', $idPage)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

}
