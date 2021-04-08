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
                'numero' => '32',
                'rue' => 'Chemin du Ropi',
                'pays' => $this->getReference('Be'),
                'typeAdresse' => Adresse::COMMERCE,
                'ville' => $this->getReference('Mons')
            ],
            'Adresse Fonds' => [
                'actif' => true,
                'numero' => '24',
                'rue' => 'Rue de Ghlin',
                'pays' => $this->getReference('Be'),
                'typeAdresse' => Adresse::COMMERCE,
                'ville' => $this->getReference('Jemappes')
            ],
            'Adresse Farms' => [
                'actif' => true,
                'numero' => '2',
                'rue' => 'Rue des droits de l’Homme (face aux cours de justice)',
                'pays' => $this->getReference('Be'),
                'typeAdresse' => Adresse::COMMERCE,
                'ville' => $this->getReference('Mons')
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
            VilleFixtures::class,
            PaysFixtures::class
        ];
    }
}
