<?php
namespace App\Controller;

use App\Entity\Fichier;
use App\Form\FichierType;
use App\Kernel;
use http\Exception\UnexpectedValueException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ImageController
 * @package App\Controller
 *
 * @Route("/admin/image", name="admin_image_")
 *
 */
class ImageController extends AbstractController
{

    /**
     * @Route(methods={"POST"}, name="upload")
     * @param Request $request
     * @param KernelInterface $kernel
     * @return JsonResponse
     */
    public function updateImage(Request $request, KernelInterface $kernel){

        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('fichier')['file'];
        if(isset($uploadedFile)) {
            $data = [
                'file' => $uploadedFile,
                'originalName' => $uploadedFile->getClientOriginalName()
            ];
        }else{
            return new JsonResponse(['error','Il manques les paramètres obligatoires'],400);
        }

        $form = $this->createForm(FichierType::class,null,['csrf_protection' => false]);
        $form->submit($data);

        if($form->isSubmitted() && $form->isValid()){

            /** @var Fichier $fichierImage */
            $fichierImage = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form->get('file')->getData();
            $newFilename = uniqid().'.'.$uploadedFile->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $uploadedFile->move(
                    $kernel->getProjectDir()."/public/images/upload/",
                    $newFilename
                );
            } catch (FileException $e) {
                return new JsonResponse(['error'=>$e->getMessage()],400);
            }

            $fichierImage->setLien($newFilename);

            $this->getDoctrine()->getManager()->persist($fichierImage);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse($fichierImage);
        }else{
            $tabError = [];
            foreach ($form->getErrors() as $error) {
                $tabError[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $tabError], 400);
        }
    }

}
