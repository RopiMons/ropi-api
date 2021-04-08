<?php


namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Adresse;
use App\Entity\Commerce;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class AdresseTest extends ApiTestCase
{
    private const ENDPOINT = '/api/adresses';
    /** @var Adresse[] */
    private array $adresses = [];

    use FixturesTrait;
    use EndPointTestTrait;

    public function setUp() : void
    {
        parent::setUp();
        $this->adresses = $this->loadFixtureFiles([__DIR__.'/AdresseTestFixtures.yaml']);
        self::ensureKernelShutdown();
    }

    public function testCanAccessValidAdresse(){
        $this->endPointCanAccessTest(self::ENDPOINT."/".$this->adresses["adresse_5"]->getId());
    }

    public function testCannotAccessNonValidAdresse(){
        // Echoue car le commerce lié n'est pas activé
        $this->endPointNoAccessTest(self::ENDPOINT."/".$this->adresses["adresse_0"]->getId());
        //Echoue car l'adresse n'est pas active
        $this->endPointNoAccessTest(self::ENDPOINT."/".$this->adresses["adresse_9"]->getId());
        //Echoue car c'est une adresse de facturation
        $this->endPointNoAccessTest(self::ENDPOINT."/".$this->adresses["adresse_10"]->getId());
        //Echoue car pas de commerce lié
        $this->endPointNoAccessTest(self::ENDPOINT."/".$this->adresses["adresse_11"]->getId());
    }



}
