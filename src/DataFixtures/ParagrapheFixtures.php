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
            'paragraphe-Pourquoi MLC' => [
                'titre' => "Le Ropi ne remplace pas l'euro, il le complémente !",
                'ref' => 'page-pourquoi',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => include 'Paragraphes/PourquoiRopi.php' 
            ],
            'paragraphe-Comment Depenser' => [
                'titre' => "Comment dépenser mes Ropi ?",
                'ref' => 'page-comment',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => "<p>La vocation des Ropi est de circuler, c'est à dire qu'après avoir été injectés dans le circuit par les usagers (<a href=\"https://www.ropi.be/page/Actions/Commander des Ropi\">acheter des Ropi</a>), les Ropi doivent continuer à circuler de commerçants en producteurs et de producteurs en commerçants.</p>
<p>Si un <strong>goulot d'étranglement</strong> se crée, c'est à dire que des Ropi s'accumulent dans le tiroir-caisse d'un commerçant qui n'arrive pas à les depenser, la monnaie ne remplira pas ses objectifs.</p>
<p>Mais il existe <strong>pléthore de possibilités pour faire circuler les Ropi.</strong> Nous invitons commerçants et producteurs à les utiliser sans modération! Voyez plutôt :</p>
<ul>
<li>Trouver des fournisseurs locaux et les payer en Ropi. Utiliser <a href=\"https://www.ropi.be/commerces\">l'outil de recherche</a> des commerçants et producteurs.</li>
<li>Se rendre des services entre commerçants, payés en Ropi.</li>
<li>Reprendre les Ropi de sa caisse (échange contre des euros) et les dépenser à titre personnel (loisirs, culture, achat dans les commerces locaux, ...).</li>
<li>Echanger des Ropi à un usager (membre ou non) qui en fait la demande.</li>
<li>Proposer à un usager (membre ou non) de lui rendre la monnaie en Ropi.</li>
<li>Offrir des Ropi en guise de ristournes (= carte de fidélité mutualisée).</li>
<li>Rééquilibrer les caisses entre commerçants.</li>
<li>Payer son repas du midi, une réunion d'affaire en Ropi.</li>
</ul>
<p><strong>Bref, il faut que ça circule !</strong></p>
<p>En enfin, si malgré tout ça il n'est pas possible d'écouler tous ses Ropi, <strong>il reste la possibilité de les&nbsp;<a href=\"https://www.ropi.be/page/Actions/Reconvertir%20des%20Ropi\">reconvertir</a> en euros en s'acquitant d'une taxe de <code>5</code> %</strong>.</p>
<p><strong>En dernier recours</strong>, la<strong> reconversion à 0 % (sans taxe)</strong> est possible <strong>au dessus d'un certain montant</strong>. En effet, un commerçant qui a vraiment du mal à écouler ses Ropi, peut le signaler à l'asbl qui cherchera alors une solution en collaboration avec le commerçant pour écouler les Ropi. Si aucune solution n'est trouvée endéans les deux semaines, la reconversion à 0% est acceptée pour une durée déterminée, <strong>par tranche de <code>100</code> € pour les asbl et <code>200</code> € pour les prestataires du secteur marchand</strong>.</p>"
            ],
            'paragraphe-valeurs' => [
                'titre' => "Nos Valeurs",
                'ref' => 'page-valeurs',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => "<p> Ceci sont nos valeurs </p>"
            ],
            'paragraphe-billets' => [
                'titre' => "Les billets de Ropi",
                'ref' => 'page-monnaie',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => "<p> Ceci sont nos billets </p>"
            ],
            'paragraphe-electronique' => [
                'titre' => "Le Ropi électronique (eRopi)",
                'ref' => 'page-monnaie',
                'position' => 2,
                'publicationDate' =>  null,
                'text' => "<p> Ceci est l'eRopi </p>"
            ],
            'paragraphe-bénévole' => [
                'titre' => "Les bénévoles du Ropi",
                'ref' => 'page-coulisses',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => "<p> Ceci sont nos bénévoles </p>"
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
                'text' => "<p> Ceci est le ROI</p>"
            ],
            'paragraphe-status' => [
                'titre' => "Les Statuts de l'asbl",
                'ref' => 'page-coulisses',
                'position' => 4,
                'publicationDate' =>  null,
                'text' => "<p> Ceci sont les statuts</p>"
            ],
            'paragraphe-charte' => [
                'titre' => "La Charte",
                'ref' => 'page-coulisses',
                'position' => 5,
                'publicationDate' =>  null,
                'text' => "<p> Ceci est la charte </p>"
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
                'titre' => "Enregistrer mon(mes) commerce(s) / activité(s)",
                'ref' => 'page-prestataires',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => "<p> paragraphe enregistrer mon commerce </p>"
            ],
            'paragraphe-kit' => [
                'titre' => "Kit commerçant",
                'ref' => 'page-prestataires',
                'position' => 2,
                'publicationDate' =>  null,
                'text' => "<p> paragraphe mon kit commerçant </p>"
            ],
            'paragraphe-écouler' => [
                'titre' => "Des idées pour écouler mes Ropi",
                'ref' => 'page-prestataires',
                'position' => 3,
                'publicationDate' =>  null,
                'text' => "<p> paragraphe idées pour écouler mes Ropi </p>"
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
