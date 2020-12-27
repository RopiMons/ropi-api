<?php


namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait EndPointTestTrait
{
    private function endPointCanAccessTest(string $endPoint = null, string $method = 'GET', string $roleTest = 'PUBLIC_ACCESS') : ?Response{
        if(null===$endPoint && !empty(self::ENDPOINT)){
            $endPoint = self::ENDPOINT;
        }
        /** @var Client $client */
        $client = static::createClient();

        try{
            $client->getKernelBrowser()->catchExceptions(false);
            /** @var Response $response */
            $response = $client->request($method, $endPoint);
            $client->getKernelBrowser()->catchExceptions(true);
            $this->assertResponseStatusCodeSame(\Symfony\Component\HttpFoundation\Response::HTTP_OK, $endPoint." : La demande a échouée");
            $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8',$endPoint." : Mauvais headers");
            return $response;
        }catch (NotFoundHttpException $exception){
            $this->assertTrue(false,"Le endpoint '".$endPoint."' est inaccessible !");
        }

    }

    private function endPointNoAccessTest(string $endPoint, string $method = 'GET', string $roleTest = 'PUBLIC_ACCESS') : void{
        /** @var Client $client */
        $client = static::createClient();

        try{
            $client->getKernelBrowser()->catchExceptions(false);
            /** @var Response $response */
            $response = $client->request($method, $endPoint);
            $client->getKernelBrowser()->catchExceptions(true);
            $this->assertSame(\Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND, $response->getStatusCode(), $endPoint." : La réponse n'est pas 404");
        }catch (NotFoundHttpException $exception){
            $this->assertTrue($exception instanceof NotFoundHttpException,get_class($exception)." : ".$exception->getMessage());
        }

    }

    private function collectionTest(Response $response, int $expectedCount){
        $responseArray = $response->toArray();
        $testable = !empty($responseArray["@type"]) && $responseArray["@type"] === "hydra:Collection";
        $this->assertTrue($testable);
        if($testable) {
            $this->assertCount($expectedCount, $responseArray['hydra:member']);
            $this->assertSame($expectedCount, $responseArray['hydra:totalItems']);
        }
    }

}
