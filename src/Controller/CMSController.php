<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CMSController
 * @package App\Controller
 *
 * @Route("/page",name="page")
 */
class CMSController extends AbstractFOSRestController
{
    /**
     * @return Response
     */
    public function index() : Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CMSController.php',
        ]);
    }
}
