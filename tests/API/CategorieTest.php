<?php


namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Categorie;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class CategorieTest extends ApiTestCase
{
    private const ENDPOINT = '/api/menu';
    /** @var Categorie[] */
    private array $categories = [];

    use FixturesTrait;
    use EndPointTestTrait;

    public function setUp() : void
    {
        parent::setUp();
        $this->categories = $this->loadFixtureFiles([__DIR__.'/CategorieTestFixtures.yaml']);
        self::ensureKernelShutdown();
    }

    public function testCanAccessValidAdresse()
    {
        $response = $this->endPointCanAccessTest();
        $this->collectionTest($response, 3);

        $arrayTest = $response->toArray();

        $this->assertArrayHasKey('hydra:member', $arrayTest);

        $this->assertArrayHasKey('@id', $arrayTest['hydra:member'][0]);
        $this->assertArrayHasKey('@id', $arrayTest['hydra:member'][1]);
        $this->assertArrayHasKey('@id', $arrayTest['hydra:member'][2]);

        $this->assertArrayHasKey('pages', $arrayTest['hydra:member'][0]);
        $this->assertArrayHasKey('pages', $arrayTest['hydra:member'][1]);
        $this->assertArrayHasKey('pages', $arrayTest['hydra:member'][2]);

        //Vérification du tri et des bon éléments retournés
        $this->assertSame('/api/categories/' . $this->categories['categorie_2']->getId(), $arrayTest['hydra:member'][0]['@id']);
        $this->assertSame('/api/categories/' . $this->categories['categorie_1']->getId(), $arrayTest['hydra:member'][1]['@id']);
        $this->assertSame('/api/categories/' . $this->categories['categorie_4']->getId(), $arrayTest['hydra:member'][2]['@id']);

        $this->assertArrayHasKey('enfants', $arrayTest['hydra:member'][2]);
        $this->assertCount(2,$arrayTest['hydra:member'][2]['enfants']);
        $this->assertArrayHasKey('pages', $arrayTest['hydra:member'][2]['enfants'][0]);
        $this->assertCount(2,$arrayTest['hydra:member'][2]['enfants'][0]['pages']);
        $this->assertCount(1,$arrayTest['hydra:member'][2]['enfants'][1]['pages']);

        //Vérification du tri des sous-catégories
        $this->assertSame('/api/categories/' . $this->categories['categorie_enfant_3']->getId(), $arrayTest['hydra:member'][2]['enfants'][0]['@id']);
        $this->assertSame('/api/categories/' . $this->categories['categorie_enfant_1']->getId(), $arrayTest['hydra:member'][2]['enfants'][1]['@id']);

        //Vérification du tri des pages des sous-catégories
        $this->assertSame('/api/page_statiques/' . $this->categories['pages_8']->getId(), $arrayTest['hydra:member'][2]['enfants'][0]['pages'][0]['@id']);
        $this->assertSame('/api/page_statiques/' . $this->categories['pages_6']->getId(), $arrayTest['hydra:member'][2]['enfants'][0]['pages'][1]['@id']);

        $this->assertCount(4,$arrayTest['hydra:member'][0]['pages']);
        $this->assertCount(1,$arrayTest['hydra:member'][1]['pages']);
        $this->assertCount(0,$arrayTest['hydra:member'][2]['pages']);

        //Vérification du tri des pages des menus parents
        $this->assertSame('/api/page_statiques/' . $this->categories['pages_10']->getId(), $arrayTest['hydra:member'][0]['pages'][0]['@id']);
        $this->assertSame('/api/page_statiques/' . $this->categories['pages_1']->getId(), $arrayTest['hydra:member'][0]['pages'][1]['@id']);

    }

    public function testCanAccessValideCategorie(){
        $this->endPointCanAccessTest('/api/categories/'.$this->categories["categorie_1"]->getId());
        $this->endPointCanAccessTest('/api/categories/'.$this->categories["categorie_enfant_3"]->getId());
    }

    public function testCannotAccessNonValidCategory()
    {
        // Echoue car la catégorie n'a pas de page active
        $this->endPointNoAccessTest('/api/categories/' . $this->categories["categorie_3"]->getId());
        //Echoue car la catégorie n'a pas de pages
        $this->endPointNoAccessTest('/api/categories/' . $this->categories["categorie_5"]->getId());
        $this->endPointNoAccessTest('/api/categories/' .$this->categories["categorie_enfant_2"]->getId());
    }
}
