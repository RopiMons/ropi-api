<?php


namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Commerce;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class CommerceTest extends ApiTestCase
{
    private const ENDPOINT = '/api/commerces';
    /** @var Commerce[] */
    private array $commerces = [];

    use FixturesTrait;
    use EndPointTestTrait;

    public function setUp() : void
    {
        parent::setUp();
        $this->commerces = $this->loadFixtureFiles([__DIR__.'/CommerceTestFixtures.yaml']);
        self::ensureKernelShutdown();
    }

    public function testCanAccessCommerces(){
        $response = $this->endPointCanAccessTest();
        $this->collectionTest($response, 8);
    }

    public function testCanAccessValidCommerce(){
        $this->endPointCanAccessTest(self::ENDPOINT."/".$this->commerces["commerce_5"]->getId());
    }

    public function testCannotAccessNonValidCommerce(){
        //Echoue car le commerce est désactivé
        $this->endPointNoAccessTest(self::ENDPOINT."/".$this->commerces["commerce_0"]->getId());
        //Echoue car l'adresse principale liée au commerce est désactivée
        $this->endPointNoAccessTest(self::ENDPOINT."/".$this->commerces["commerce_9"]->getId());
        //Echoue car il n'y pas d'adresse de type "commerce" liée à ce commerce
        $this->endPointNoAccessTest(self::ENDPOINT."/".$this->commerces["commerce_10"]->getId());
    }



}
