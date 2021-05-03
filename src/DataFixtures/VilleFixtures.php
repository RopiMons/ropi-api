<?php

namespace App\DataFixtures;

use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VilleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $array = [
            'Mons' => [
                'codePostal' => '7000',
                'ville' => 'Mons',
                'pays' => $this->getReference('Be')
            ],
            'Jemappes' => [
                'codePostal' => '7012',
                'ville' => 'Jemappes',
                'pays' => $this->getReference('Be')
            ]
        ];

        foreach ($array as $name => $element){
            $object = new Ville();
            foreach ($element as $proprety => $value) {
                $fonctionName = "set" . ucfirst($proprety);
                $object->$fonctionName($value);
            }
            $this->addReference($name, $object);
            $manager->persist($object);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PaysFixtures::class
        ];
    }
}
