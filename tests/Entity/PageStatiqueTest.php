<?php

namespace App\Tests\Entity;

use App\Entity\PageStatique;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\ConstraintViolationInterface;

class PageStatiqueTest extends WebTestCase
{
    private function getGoodPageStatique() : PageStatique {
        return (new PageStatique())->setPosition(1)->setTitreMenu('Je suis un chouette titre');
    }
    private function countExpectedErrors(PageStatique $pageStatique, int $nbErrors = 0 ){
        //$errors = Validation::createValidatorBuilder()->enableAnnotationMapping(true)->setConstraintValidatorFactory(new ConstraintValidatorFactory())->addDefaultDoctrineAnnotationReader()->getValidator()->validate($pageStatique);
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($pageStatique);
        $messages = [];
        /** @var ConstraintViolationInterface $error */
        foreach($errors as $error){
            $messages[] = $error->getPropertyPath()." : ".$error->getMessage();
        }
        $this->assertCount($nbErrors,$errors,implode(", ",$messages));
    }

    use FixturesTrait;

    public function testGoodValidation()
    {
        $this->countExpectedErrors($this->getGoodPageStatique());
    }

    public function testTitreMenu()
    {
        $this->loadFixtureFiles([
            __DIR__.'/PageStatiqueTestFixtures.yaml'
        ]);
        $this->countExpectedErrors($this->getGoodPageStatique()->setTitreMenu('  '),1);
        $this->countExpectedErrors($this->getGoodPageStatique()->setTitreMenu(''),2);
        $this->countExpectedErrors($this->getGoodPageStatique()->setTitreMenu('de'),1);
        $this->countExpectedErrors($this->getGoodPageStatique()->setTitreMenu('de'),1);
        $this->countExpectedErrors($this->getGoodPageStatique()->setTitreMenu('Fonctionnement'),1);
    }

}
