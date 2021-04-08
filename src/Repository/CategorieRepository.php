<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\Expr\Join;
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
        $qb = $this
            ->createQueryBuilder("menu")
            ;
        return $qb
            ->select(["menu","pages","enfants"])
            ->leftJoin("menu.enfants","enfants")
            ->leftJoin("menu.pages","pages", Join::WITH, "pages.isActif = :true")
            ->leftJoin("enfants.pages","pages_via_enfant",  Join::WITH, "pages_via_enfant.isActif = :true")
            ->orderBy("menu.position","ASC")
            ->setParameter('true',true)
            ->where($qb->expr()->isNotNull('pages.id')." OR ".$qb->expr()->isNotNull("pages_via_enfant.id"))
            ;
    }

    public function getStructuredMenu(){
        return $this->getPageLevelStructuredMenu()
            ->andWhere('menu.parent IS NULL')
            ->getQuery()
            ->execute()
            ;
    }

    public function getCategorie(int $id){
        return $this->getPageLevelStructuredMenu()
            ->andWhere("menu.id = :id")
            ->setParameter('id',$id)
            ->getQuery()
            ->execute(null,AbstractQuery::HYDRATE_OBJECT)
            ;
    }
}
