<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

    private function getPageLevelStructuredMenu() : QueryBuilder{
        return $this
            ->createQueryBuilder("menu")
            ->select(["menu","pages","enfants"])
            ->leftJoin("menu.enfants","enfants")
            ->join("menu.pages","pages")
            ->andWhere("pages.isActif = :true")
            ->orderBy("pages.position","ASC")
            ->addOrderBy("menu.position","ASC")
            ->setParameter('true',true)
            ;
    }

    public function getStructuredMenu(){
        return $this->getPageLevelStructuredMenu()
            ->getQuery()
            ->execute()
            ;
    }
}
