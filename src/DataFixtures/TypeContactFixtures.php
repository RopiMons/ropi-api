<?php

namespace App\DataFixtures;

use App\Entity\TypeContact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeContactFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $array = [
            'Email' => [
                'type' => "Email",
                'obligatoire' => true,
                'proposeInscription' => true,
                'validateur' => 'Email',
            ]
        ];

        foreach ($array as $name => $element) {
            $object = new TypeContact();
            foreach ($element as $proprety => $value) {
                if (null !== $value) {
                    $fonctionName = "set" . ucfirst($proprety);
                    $object->$fonctionName($value);
                }
            }
            $this->addReference($name, $object);
            $manager->persist($object);
        }

        $manager->flush();
    }
}
