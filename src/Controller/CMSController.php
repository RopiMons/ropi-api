<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Page;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CMSController
 * @package App\Controller
 *
 * @Route(name="page_")
 *
 */
class CMSController extends AbstractFOSRestController
{

    /**
     * @param Page $page
     * @return \FOS\RestBundle\View\View
     *
     * @Rest\Get("/page/{slug}",name="get")
     * @Rest\View(serializerGroups={"page_complete"})
     */
    public function getPage(Page $page){
        return $this->view($this->getDoctrine()->getManager()->getRepository(get_class($page))->getCompletePage($page->getId()));
    }


    /**
     * @Rest\Get("/menu", name="menu")
     * @Rest\View(serializerGroups={"Default","pages"={"page_reduite"}})
     *
     */
    public function getMenu(){
        return $this->view($this->getDoctrine()->getManager()->getRepository(Categorie::class)->getStructuredMenu());
    }

}
