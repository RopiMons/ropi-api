<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\PageStatique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PageStatiqueFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $array = [
            'page-pourquoi' => [
                'position' => 1,     
                'isActif' => true,
                'titreMenu' => 'Pourquoi le Ropi ?',
                'categorie' => $this->getReference('categorie-a-propos')
            ],
            'page-comment' => [
                'position' => 2,
                'isActif' => true,
                'titreMenu' => 'Comment fonctionne le Ropi ?',
                'categorie' => $this->getReference('categorie-a-propos')
            ],
            'page-valeurs' => [
                'position' => 3,
                'isActif' => true,
                'titreMenu' => 'Nos valeurs',
                'categorie' => $this->getReference('categorie-a-propos')
            ],
            'page-monnaie' => [
                'position' => 4,
                'isActif' => true,
                'titreMenu' => 'La monnaie',
                'categorie' => $this->getReference('categorie-a-propos')
            ],    
            'page-coulisses' => [
                'position' => 6,
                'isActif' => true,
                'titreMenu' => 'Les coulisses',
                'categorie' => $this->getReference('categorie-a-propos')
            ],
            'page-usagers' => [
                'position' => 1,
                'isActif' => true,
                'titreMenu' => 'Je suis un usager',
                'categorie' => $this->getReference('categorie-en-pratique')
            ],
            'page-prestataires' => [
                'position' => 2,
                'isActif' => true,
                'titreMenu' => 'Je suis un prestataire',
                'categorie' => $this->getReference('categorie-en-pratique')
            ],
            'page-actualités' => [
                'position' => 1,
                'isActif' => true,
                'titreMenu' => 'Actualités',       
                'categorie' => $this->getReference('categorie-actualités')
            ],
            'page-contact' => [
                'position' => 1,
                'isActif' => true,
                'titreMenu' => 'Contact',       
                'categorie' => $this->getReference('categorie-contact')
            ],
            'page-portefeuille-billets' => [
                'position' => 1,
                'isActif' => true,
                'titreMenu' => 'Mon portefeuille de billets Ropi',
                'categorie' => $this->getReference('categorie-login')
            ],
            'page-portefeuille-eRopi' => [
                'position' => 2,
                'isActif' => true,
                'titreMenu' => 'Mon portefeuille électronique (eRopi)',
                'categorie' => $this->getReference('categorie-login')
            ],
            'page-données-utilisateurs' => [
                'position' => 3,
                'isActif' => true,
                'titreMenu' => 'Gérer mes données personnelles',
                'categorie' => $this->getReference('categorie-login')
            ],
            'page-données-commerces' => [
                'position' => 4,
                'isActif' => true,
                'titreMenu' => 'Gérer mes commerces',
                'categorie' => $this->getReference('categorie-login')
            ],
            'page-démocratie-bénévoles' => [
                'position' => 5,
                'isActif' => true,
                'titreMenu' => 'Bénévoles',
                'categorie' => $this->getReference('categorie-login')
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

    public function getDependencies()
    {
        return array(
            CategorieFixtures::class
        );
    }
}
