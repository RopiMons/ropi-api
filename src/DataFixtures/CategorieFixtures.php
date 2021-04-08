<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $array = [
            'categorie-a-propos' => [
                'position' => 1,
                'nom' => 'A propos',
                'faIcone' => 'far fa-question-circle'
            ],
            'categorie-en-pratique' => [
                'position' => 2,
                'nom' => 'En pratique',
                'faIcone' => 'fa fa-play'
            ],
            'categorie-actualités' => [
                'position' => 3,
                'nom' => 'Actualités',
                'faIcone' => 'far fa-newspaper'
            ],
            'categorie-contact' => [
                'position' => 4,
                'nom' => 'Contact',
                'faIcone' => 'far fa-address-book'
            ],
            'categorie-login' => [
                'position' => 5,
                'nom' => 'Mon compte',
                'faIcone' => 'fas fa-sign-in-alt'
            ]
        ];

        foreach ($array as $name => $element){
            $object = new Categorie();
            foreach ($element as $proprety => $value){
                $fonctionName = "set".ucfirst($proprety);
                $object->$fonctionName($value);
            }
            $this->addReference($name,$object);
            $manager->persist($object);
        }

        $manager->flush();
    }
}
