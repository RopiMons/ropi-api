<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Page;
use App\Form\CategorieType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CMSController
 * @package App\Controller
 *
 */
class CMSController extends AbstractFOSRestController
{

    /**
     * @param Page $page
     * @return \FOS\RestBundle\View\View
     *
     * @Rest\Get("/page/{slug}",name="page_get")
     * @Rest\View(serializerGroups={"page_complete"})
     */
    public function getPage(Page $page){
        return $this->view($this->getDoctrine()->getManager()->getRepository(get_class($page))->getCompletePage($page->getId()));
    }


    /**
     * @Rest\Get("/menu", name="page_menu")
     * @Rest\View(serializerGroups={"Default","pages"={"page_reduite"}})
     *
     */
    public function getMenu(){
        return $this->view($this->getDoctrine()->getManager()->getRepository(Categorie::class)->getStructuredMenu());
    }

    /**
     * @Route("/admin/cms", name="admin_cms")
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_CMS_CREATE')")
     */
    function getCMS(){
        $pages = $this->getDoctrine()->getRepository(Categorie::class)->findAll();

        return $this->render('cms/admin_index.html.twig',[
            'categories' => $pages
        ]);

    }

    /**
     * @param Request $request
     * @param Categorie|null $categorie
     *
     * @Route("/admin/cms/categorie", name="admin_cms_add_categorie")
     * @Route("/admin/cms/categorie/update/{categorie<\d+>}", name="admin_cms_update_categorie")
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_CMS_CREATE')")
     */
    function addCategorie(Request $request, Categorie $categorie = null){
        $form = $this->createForm(CategorieType::class);

        return $this->render('admin/generique_form.html.twig',[
            'titre' => 'Ajouter une catégorie',
            'form' => $form->createView()
        ]);
    }


}
