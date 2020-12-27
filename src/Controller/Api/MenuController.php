<?php


namespace App\Controller\Api;


use App\Entity\Categorie;
use App\Interfaces\Positionnable;
use Doctrine\Common\Collections\ArrayCollection;

class MenuController
{

    private function getNewArrayCollection(\Traversable $iterator): ArrayCollection{
        $iterator->uasort(function(Positionnable $a, Positionnable $b){
            if($a->getPosition()===$b->getPosition()){
                return 0;
            }
            return ($a->getPosition() < $b->getPosition()) ? -1 : 1;
        });
        //Ré-écriture des clées
        $newTab = iterator_to_array($iterator);
        $newArrayCollection = new ArrayCollection();
        foreach ($newTab as $element){
            $newArrayCollection[] = $element;
        }
        return $newArrayCollection;
    }

    public function __invoke(array $data): array
    {
        /** @var Categorie $categorie */
        foreach ($data as $categorie){
            // Tri des pages de chaque catégorie
            $categorie->setPages($this->getNewArrayCollection($categorie->getPages()->getIterator()));

            $enfants = $categorie->getEnfants();
            if($enfants->count() > 0)
            {
                //Tri des enfants des catégories
                $categorie->setEnfants($this->getNewArrayCollection($enfants->getIterator()));

                /** @var Categorie $categorieEnfant */
                foreach ($categorie->getEnfants() as $categorieEnfant){
                    //Tri par page des sous-catégories
                    $categorieEnfant->setPages($this->getNewArrayCollection($categorieEnfant->getPages()->getIterator()));
                }
            }
        }
        return $data;
    }
}
