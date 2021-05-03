<?php

namespace App\DataFixtures;

use App\Entity\Pays;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PaysFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $array = [
            'Be' => [
                'nom' => 'Belgique',
                'nomCourt' => 'Be',
                'regexCodePostal' => '^[1-9]\d{3}$'
            ],
            'Fr' => [
                'nom' => 'France',
                'nomCourt' => 'Fr',
                'regexCodePostal' => '\d{5}'
            ]
        ];

        foreach ($array as $name => $element){
            $object = new Pays();
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
