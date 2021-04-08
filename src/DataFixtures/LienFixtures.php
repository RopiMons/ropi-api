<?php

namespace App\DataFixtures;

use App\Entity\Lien;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LienFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $array = [
            'Lien Ropi 1' => [
                'url' => 'https://www.ropi.be',
                'lastCheck' => new \DateTime(),
                'isSuspicious' => false
            ],
            'Lien Ropi 2' => [
                'url' => 'https://www.facebook.com/RopiAsbl',
                'lastCheck' => new \DateTime(),
                'isSuspicious' => false
            ],
            'FD 1' => [
                'url' => 'https://www.facebook.com/habitatpetitmarais',
                'lastCheck' => new \DateTime(),
                'isSuspicious' => false
            ],
            'FD 2' => [
                'url' => 'http://www.lesfondusdupetitmarais.be',
                'lastCheck' => new \DateTime(),
                'isSuspicious' => false
            ]
            ,
            'Farms 1' => [
                'url' => 'https://www.leshallesdumanege.be/',
                'lastCheck' => new \DateTime(),
                'isSuspicious' => false
            ],
            'Farms 2' => [
                'url' => 'https://www.facebook.com/farm.leshallescooperatives',
                'lastCheck' => new \DateTime(),
                'isSuspicious' => false
            ]
        ];

        foreach ($array as $name => $element){
            $object = new Lien();
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
