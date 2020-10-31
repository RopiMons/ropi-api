<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\PageStatique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PageStatiqueFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $array = [
            'Page 1' => [
                'position' => 1,
                'isActif' => true,
                'titreMenu' => 'Fonctionnement',
                'categorie' => $this->getReference('A propos')
            ],
            'Page 2' => [
                'position' => 2,
                'isActif' => true,
                'titreMenu' => 'Ecouler ses ropis',
                'categorie' => $this->getReference('A propos')
            ]
        ];

        foreach ($array as $name => $element){
            $object = new PageStatique();
            foreach ($element as $proprety => $value){
                $fonctionName = "set".ucfirst($proprety);
                $object->$fonctionName($value);
            }
            $this->addReference($name,$object);
            $manager->persist($object);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CategorieFixtures::class
        );
    }
}
