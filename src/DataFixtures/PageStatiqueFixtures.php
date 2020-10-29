<?php

namespace App\DataFixtures;

use App\Entity\PageStatique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PageStatiqueFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $array = [
            'Page 1' => [
                'position' => 1,
                'isActif' => true,
                'titreMenu' => 'Le ropi, mode d\'emploi'
            ],
            'Page 2' => [
                'position' => 2,
                'isActif' => true,
                'titreMenu' => 'Ecouler ses ropis'
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
}
