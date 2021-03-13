<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $array = [
            'Billet 10' => [
                'nom' => '10 Ropi',
                'image' => 'article/g0jop3vo.bmp',
                'actif' => true,
                'description' => 'Billet de 10 Ropi',
                'prix' => 10,
                'stock' => 1000
            ],
            'Billet 5' => [
                'nom' => '5 Ropi',
                'image' => 'article/lgt8ddel.bmp',
                'actif' => true,
                'description' => 'Billet de 5 Ropi',
                'prix' => 5,
                'stock' => 1000
            ],
            'Billet 1' => [
                'nom' => '1 Ropi',
                'image' => 'article/sd78rlag.bmp',
                'actif' => true,
                'description' => 'Billet de 1 Ropi',
                'prix' => 1,
                'stock' => 1000
            ],
            'Billet 05' => [
                'nom' => '1/2 Ropi',
                'image' => 'article/b56uvy5v.bmp',
                'actif' => true,
                'description' => 'Billet de 0,5 Ropi',
                'prix' => 0.5,
                'stock' => 1000
            ]
        ];

        foreach ($array as $name => $element) {
            $object = new Article();
            foreach ($element as $proprety => $value) {
                $fonctionName = "set" . ucfirst($proprety);
                $object->$fonctionName($value);
            }
            $this->addReference($name, $object);
            $manager->persist($object);
        }

        $manager->flush();
    }
}
