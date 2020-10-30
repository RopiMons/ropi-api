<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\PageStatique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $array = [
            'A propos' => [
                'position' => 1,
                'nom' => 'A propos',
                'faIcone' => 'far fa-question-circle'
            ],
            'En pratique' => [
                'position' => 2,
                'nom' => 'En pratique',
                'faIcone' => 'fa fa-play'
            ],
            'Actualités' => [
                'position' => 3,
                'nom' => 'Actualités',
                'faIcone' => 'far fa-newspaper'
            ],
            'Contact' => [
                'position' => 4,
                'nom' => 'Contact',
                'faIcone' => 'far fa-address-book'
            ],
            'Login' => [
                'position' => 5,
                'nom' => 'Login',
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
