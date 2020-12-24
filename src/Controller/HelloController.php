<?php


namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/",name="home")
     * @Security("is_granted('PUBLIC_ACCESS')")
     *
     */
    function indexAction(){
        return $this->render("hello/index.html.twig");
    }
}
