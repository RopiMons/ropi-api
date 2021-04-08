<?php

namespace App\DataFixtures;

use App\Entity\Commerce;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommerceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        // BUG : typo "lien" devrait être au pluriel "liens" ??
        $array = [
            'Ropi' => [
                'nom' => 'Ropi ASBL',
                'slogan' => 'Payez en argent comptant !',
                'visible' => true,
                'textColor' => '#ffffff',
                'createdAt' => new DateTime(),
                'updateAt' => new DateTime(),
                'bgImage' => 'http://ropi.be/img/ROPI_WEB_BG_BL.png',
                'isComptoir' => false,
                'lat' => '50.4552629',
                'lon' => '3.9510846',
                'logo' => 'https://ropi.be/img/ropi_logo.png',
                'lien' => ['Lien Ropi 1', 'Lien Ropi 2'],
                'adresse' => ['Adresse Ropi']
            ],
            'Fonds' => [
                'nom' => 'Fonds du petit marais',
                'slogan' => 'Lieu de vie communautaire et démocratique',
                'visible' => true,
                'textColor' => '#ffffff',
                'createdAt' => new DateTime(),
                'updateAt' => new DateTime(),
                'bgImage' => 'http://mfs0.cdnsw.com/fs/Root/large/d1fd0-IMG_20150820_191811.jpg',
                'isComptoir' => true,
                'lat' => '50.455242',
                'lon' => '3.893146',
                'logo' => 'https://localhost:8000/images/logo/fcj_petitMarais.png',
                'lien' => ['FD 1', 'FD 2'],
                'adresse' => ['Adresse Fonds']
            ],
            'Halles' => [
                'nom' => 'Halles coopératives - Farms',
                'slogan' => 'Marché bio coopératif',
                'visible' => true,
                'textColor' => '#ffffff',
                'createdAt' => new DateTime(),
                'updateAt' => new DateTime(),
                'bgImage' => 'https://localhost:8000/images/bgimages/leshallesdumanege_press-03-2.jpg',
                'isComptoir' => true,
                'lat' => '50.45699627691573',
                'lon' => '3.9571948961708836',
                'logo' => 'https://localhost:8000/images/logo/HallesLogo.png',
                'lien' => ['Farms 1', 'Farms 2'],
                'adresse' => ['Adresse Farms']
            ],
        ];
       
        foreach ($array as $name => $element){
            $object = new Commerce();
            foreach ($element as $proprety => $value){

                if($proprety!=='adresse' && $proprety!=='lien') {
                    $fonctionName = "set" . ucfirst($proprety);
                    $object->$fonctionName($value);
                }else{
                    $fonctionName = "Add" . ucfirst($proprety);
                    foreach ($value as $item) {
                        $object->$fonctionName($this->getReference($item));
                    }
                }
            }
            $manager->persist($object);
        }
        $manager->flush();
    }

    public function getDependencies()
{
    return [
        LienFixtures::class,
        AdresseFixtures::class
    ];
}
}
