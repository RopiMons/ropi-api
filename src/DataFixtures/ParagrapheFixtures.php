<?php

namespace App\DataFixtures;

use App\Entity\Paragraphe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ParagrapheFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $array = [
            'paragraphe-pourquoi-mlc' => [
                'titre' => "Pourquoi une monnaie complémentaire ?",
                'ref' => 'page-pourquoi-du-comment',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => include 'Paragraphes/PourquoiRopi.php' 
            ],          
            'paragraphe-comment-ropi' => [              
                'titre' => "Comment fonctionne le Ropi ?",                    
                'ref' => 'page-pourquoi-du-comment',                    
                'position' => 2,                    
                'publicationDate' =>  null,                    
                'text' => include 'Paragraphes/CommentRopi.php'             
            ],                
            'paragraphe-comment-depenser' => [
                'titre' => "Comment dépenser mes Ropi ?",
                'ref' => 'page-pourquoi-du-comment',
                'position' => 3,
                'publicationDate' =>  null,
                'text' => include 'Paragraphes/depenser.php' 
            ],
            'paragraphe-vision' => [
                'titre' => "Notre vision",
                'ref' => 'page-vision-mission-valeurs-objectifs',
                'position' => 1,
                'publicationDate' =>  null,
                'text' =>  include 'Paragraphes/vision.php' 
            ],
            'paragraphe-mission' => [
                'titre' => "Notre mission",
                'ref' => 'page-vision-mission-valeurs-objectifs',
                'position' => 2,
                'publicationDate' =>  null,
                'text' =>  include 'Paragraphes/mission.php' 
            ],
            'paragraphe-valeurs' => [
                'titre' => "Nos valeurs",
                'ref' => 'page-vision-mission-valeurs-objectifs',
                'position' => 3,
                'publicationDate' =>  null,
                'text' =>  include 'Paragraphes/valeurs.php' 
            ],
            'paragraphe-objectifs' => [
                'titre' => "Nos objectifs",
                'ref' => 'page-vision-mission-valeurs-objectifs',
                'position' => 4,
                'publicationDate' =>  null,
                'text' =>  include 'Paragraphes/objectifs.php' 
            ],
            'paragraphe-billets' => [
                'titre' => "Les billets de Ropi",
                'ref' => 'page-monnaie',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => include 'Paragraphes/billet.php'
            ],
            'paragraphe-electronique' => [
                'titre' => "Le Ropi électronique (eRopi)",
                'ref' => 'page-monnaie',
                'position' => 2,
                'publicationDate' =>  null,
                'text' => include 'Paragraphes/spe.php'
            ],        
            'paragraphe-bénévole' => [
                'titre' => "Les bénévoles du Ropi",
                'ref' => 'page-coulisses',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => include 'Paragraphes/equipe.php'
            ],
            'paragraphe-chiffres' => [
                'titre' => "Les chiffres / bilan ",
                'ref' => 'page-coulisses',
                'position' => 2,
                'publicationDate' =>  null,
                'text' => "<p> Ceci sont les chiffres</p>"
            ],
            'paragraphe-roi' => [
                'titre' => "Le Règlement d'Ordre Intérieur",
                'ref' => 'page-coulisses',
                'position' => 3,
                'publicationDate' =>  null,
                'text' => include 'Paragraphes/roi.php'
            ],
            'paragraphe-status' => [
                'titre' => "Les Statuts de l'asbl",
                'ref' => 'page-coulisses',
                'position' => 4,
                'publicationDate' =>  null,
                'text' => include 'Paragraphes/statuts.php'
            ],
            'paragraphe-charte' => [
                'titre' => "La Charte",
                'ref' => 'page-coulisses',
                'position' => 5,
                'publicationDate' =>  null,
                'text' =>  include 'Paragraphes/charte.php'
            ],
            'paragraphe-commander' => [
                'titre' => "Obtenir des Ropi",
                'ref' => 'page-usagers',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => "<p> Obtenir des Ropi billets ou élecroniques </p>"
            ],
            'paragraphe-prestataire' => [
                'titre' => "Liste des prestataires",
                'ref' => 'page-usagers',
                'position' => 2,
                'publicationDate' =>  null,
                'text' => "<p> Page commerçants </p>"
            ],
            'paragraphe-aider' => [
                'titre' => "Devenir bénévole",
                'ref' => 'page-usagers',
                'position' => 3,
                'publicationDate' =>  null,
                'text' => "<p> paragraphe devenir bénévole </p>"
            ],
            'paragraphe-membre' => [
                'titre' => "Devenir membre",
                'ref' => 'page-usagers',
                'position' => 4,
                'publicationDate' =>  null,
                'text' => "<p> paragraphe devenir membre </p>"
            ],
            'paragraphe-proposer' => [
                'titre' => "Parainer un commerce",
                'ref' => 'page-usagers',
                'position' => 5,
                'publicationDate' =>  null,
                'text' => "<p> paragraphe parainer un commerce </p>"
            ],
            'paragraphe-don' => [
                'titre' => "Faire un don à l'asbl",
                'ref' => 'page-usagers',
                'position' => 6,
                'publicationDate' =>  null,
                'text' => "<p> paragraphe faire un don </p>"
            ],
            'paragraphe-enregistrer' => [
                'titre' => "Enregistrer mon commerce·s ou activité·s",
                'ref' => 'page-prestataires',
                'position' => 1,
                'publicationDate' =>  null,
                'text' =>  include 'Paragraphes/enregistrerEntreprise.php'
            ],
            'paragraphe-kit' => [
                'titre' => "Kit commerçant",
                'ref' => 'page-prestataires',
                'position' => 2,
                'publicationDate' =>  null,
                'text' => include 'Paragraphes/kitCommercants.php'
            ],
            'paragraphe-écouler' => [
                'titre' => "Des idées pour écouler mes Ropi",
                'ref' => 'page-prestataires',
                'position' => 3,
                'publicationDate' =>  null,
                'text' => include 'Paragraphes/depenser.php'
            ],
            'paragraphe-reconvertir' => [
                'titre' => "Reconvertir mes Ropi en euros",
                'ref' => 'page-prestataires',
                'position' => 4,
                'publicationDate' =>  null,
                'text' => include 'Paragraphes/Redime.php'
            ],
            'paragraphe-commander' => [
                'titre' => "Commander des Ropi",
                'ref' => 'page-portefeuille-billets',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => "<p> TODO LIEN DYNAMIQUE VERS COMMANDE BILLET </p>" 
            ],
            'paragraphe-suivi-commandes' => [
                'titre' => "Suivre mes commandes",
                'ref' => 'page-portefeuille-billets',
                'position' => 2,
                'publicationDate' =>  null,
                'text' => "<p> TODO LIEN DYNAMIQYE VERS SUIVRES MES COMMANDES </p>"
            ],
            'paragraphe-comptes-rendus' => [
                'titre' => "Comptes-rendus des réunions",
                'ref' => 'page-démocratie-bénévoles',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => "<p> Consulter les comptes rendus de réunion </p>"
            ],
            'paragraphe-démarchage' => [
                'titre' => "Mes démarchages",
                'ref' => 'page-démocratie-bénévoles',
                'position' => 2,
                'publicationDate' =>  null,
                'text' => "<p> Consulter les outils de démarchage </p>"
            ],
            'paragraphe-contact' => [
                'titre' => "Nous contacter",
                'ref' => 'page-contact',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => include 'Paragraphes/equipe.php'
            ]
        ];

        foreach ($array as $name => $element){
            $object = new Paragraphe();
            foreach ($element as $proprety => $value){
                if($proprety !== 'ref') {
                    if(null!==$value) {
                        $fonctionName = "set" . ucfirst($proprety);
                        $object->$fonctionName($value);
                    }
                }else{
                    $object->setPage($this->getReference($value));
                }
            }
            $manager->persist($object);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            PageStatiqueFixtures::class
        );
    }
}
