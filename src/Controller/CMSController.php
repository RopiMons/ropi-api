<?php

namespace App\Controller;

use App\Entity\Page;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CMSController
 * @package App\Controller
 *
 * @Route("/api/page",name="page")
 *
 */
class CMSController extends AbstractFOSRestController
{

    /**
     * @param Page $page
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Rest\Get("/{slug}",name="_get")
     * @Security("is_granted('view',page)")
     */
    public function getPage(Page $page){
        return $this->handleView($this->view($this->getDoctrine()->getManager()->getRepository(get_class($page))->getCompletePage($page->getId())));
    }

}
