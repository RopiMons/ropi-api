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
            'Paragraphe 1' => [
                'titre' => "Le Ropi ne remplace pas l'euro, il le complémente !",
                'ref' => 'Page 1',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => "<p>Il circule en parallèle à l'euro (€), et par facilité, il partage la même échelle de valeur</p><p>&nbsp;</p><p style=\"padding-left: 30px; text-align: center;\">&nbsp;<img src=\"https://www.ropi.be/source/component_parite.png\" alt=\"1 Ropi = 1 Euro + énergie positive!\" width=\"200\" height=\"76\"></p>"
            ],
            'Paragraphe 2' => [
                'titre' => "Mais alors pourquoi passer par le Ropi ?",
                'ref' => 'Page 1',
                'position' => 2,
                'publicationDate' =>  null,
                'text' => "<p>Sa spécificité par rapport à l'euro est de <strong>n'avoir court qu'au sein d'une région limitée</strong>, Mons-Borinage, et par conséquent de favoriser l'<strong>économie locale</strong> et les <strong>circuits de distribution courts</strong> (consultez <a href=\"https://www.ropi.be/page/Documents/Documents fondateurs\">nos documents fondateurs</a>). Utiliser le Ropi permet</p><ul>
                            <li>de colmater les fuites de monnaie vers l'économie extérieure, et, par voie de conséquence, de retirer la monnaie du circuit spéculatif.</li>
                            <li>de favoriser les échanges grâce à une vitesse de circulation accrue, le Ropi ne pouvant être thésaurisé.</li>
                            <li>de favoriser les échanges éthiques (respect de la nature et de l'être humain) en n'acceptant au sein du réseau que des prestataires engagés à respecter une charte éthique.</li>
                            <li>de dédoubler la monnaie : les Ropi financent la consommation locale (et éthique), et la contrepartie en euro du fonds de garantie placé dans une banque éthique&nbsp;finance des projets positifs (banque Triodos actuellement mais à terme la nouvelle banque coopérative belge New B ou des coopératives d'investissement comme Crédal seront également considérées) .</li>
                            </ul>"
            ],
            'Paragraphe 3' => [
                'titre' => "Comment dépenser mes Ropi ?",
                'ref' => 'Page 2',
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
            'Paragraphe 4' => [
                'titre' => "Mon essai ?",
                'ref' => 'Page 3',
                'position' => 1,
                'publicationDate' =>  null,
                'text' => "<p> Petit test essai </p>"
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
