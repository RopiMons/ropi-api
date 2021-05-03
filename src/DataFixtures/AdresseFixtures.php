<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AdresseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $array = [
            'Adresse Ropi' => [
                'actif' => true,
                'rueNumero' => 'Chemin du Ropi, 32',
                'typeAdresse' => Adresse::COMMERCE,
                'ville' => $this->getReference('Mons')
            ],
            'Adresse Fonds' => [
                'actif' => true,
                'rueNumero' => 'Rue de Ghlin, 24',
                'typeAdresse' => Adresse::COMMERCE,
                'ville' => $this->getReference('Jemappes')
            ]
        ];

        foreach ($array as $name => $element){
            $object = new Adresse();
            foreach ($element as $proprety => $value){
                if(null!==$value) {
                    $fonctionName = "set" . ucfirst($proprety);
                    $object->$fonctionName($value);
                }
            }
            $this->addReference($name,$object);
            $manager->persist($object);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            VilleFixtures::class
        ];
    }
}
