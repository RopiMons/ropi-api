<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Commerce;
use App\Entity\Page;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CMSController
 * @package App\Controller
 *
 * @Route(name="commerce_")
 *
 */
class CommerceController extends AbstractFOSRestController
{

    /**
     * @param Page $page
     * @return \FOS\RestBundle\View\View
     *
     * @Rest\Get("/commerce",name="get")
     */
    public function getPage(){
        return $this->view($this->getDoctrine()->getManager()->getRepository(Commerce::class)->getCommerces());
    }

}
