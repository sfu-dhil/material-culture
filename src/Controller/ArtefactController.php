<?php

namespace App\Controller;

use App\Entity\Artefact;
use App\Entity\Image;
use App\Form\ImageType;
use App\Form\ReferencesType;
use App\Services\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Nines\UtilBundle\Controller\PaginatorTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Artefact controller.
 *
 * @Route("/artefact")
 */
class ArtefactController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Add an image to a artefact.
     *
     * @param Request $request
     * @param Artefact $artefact
     *
     * @throws HttpException
     *
     * @return RedirectResponse
     *
     * @Route("/{id}", name="artefact_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Request $request, Artefact $artefact) {
        switch ($artefact->getCategory()) {
            case Artefact::BOTTLE:
                return $this->redirectToRoute('bottle_show', array('id' => $artefact->getId()));
            case Artefact::CAN:
                return $this->redirectToRoute('can_show', array('id' => $artefact->getId()));
            case Artefact::CERAMIC:
                return $this->redirectToRoute('ceramic_show', array('id' => $artefact->getId()));
            default:
                throw new HttpException(500, 'Cannot generate URL for artefact of type ' . $artefact->getCategory());
        }
    }

    /**
     * Edit the references associated with an artefact.
     *
     * @param Request $request
     * @param Artefact $artefact
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/references", name="artefact_references", methods={"GET","POST"})
     * @Template()
     */
    public function referencesAction(Request $request, Artefact $artefact) {
        $oldReferences = $artefact->getReferences()->getValues();

        $form = $this->createForm(ReferencesType::class, $artefact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            dump($artefact);
            foreach ($artefact->getReferences() as $reference) {
                if ( ! $reference->getId()) {
                    $reference->setArtefact($artefact);
                }
            }
            $newReferences = $artefact->getReferences();
            foreach ($oldReferences as $reference) {
                if ( ! $newReferences->contains($reference)) {
                    $em->remove($reference);
                }
            }
            $em->flush();
            $this->addFlash('success', 'The artefact has been updated.');

            return $this->redirectToRoute('artefact_show', array('id' => $artefact->getId()));
        }

        return array(
            'artefact' => $artefact,
            'form' => $form->createView(),
        );
    }

    /**
     * Add an image to a artefact.
     *
     * @param Request $request
     * @param Artefact $artefact
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/add_image", name="artefact_add_image", methods={"GET", "POST"})
     * @Template()
     */
    public function addImage(Request $request, Artefact $artefact, EntityManagerInterface $em) {
        $image = new Image();
        $image->setArtefact($artefact);
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($image);
            $em->flush();
            $this->addFlash('success', 'Image has been added.');

            return $this->redirectToRoute('artefact_show', array('id' => $artefact->getId()));
        }

        return array(
            'artefact' => $artefact,
            'image' => $image,
            'form' => $form->createView(),
        );
    }

    /**
     * Add an image to a artefact.
     *
     * @param Request $request
     * @param Artefact $artefact
     * @param Image $image
     * @param FileUploader $fileUploader
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/edit_image/{image_id}", name="artefact_edit_image", methods={"GET","POST"})
     * @ParamConverter("image", options={"id" = "image_id"})
     * @Template()
     */
    public function editImage(Request $request, FileUploader $fileUploader, Artefact $artefact, Image $image, EntityManagerInterface $em) {
        $form = $this->createForm(ImageType::class, $image);
        $form->remove('imageFile');
        $form->add('newImageFile', FileType::class, array(
            'label' => 'Replacement Image',
            'required' => true,
            'required' => false,
            'attr' => array(
                'help_block' => "Select a file to upload which is less than {$fileUploader->getMaxUploadSize(false)} in size.",
                'data-maxsize' => $fileUploader->getMaxUploadSize(),
            ),
            'mapped' => false,
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (($upload = $form->get('newImageFile')->getData())) {
                $image->setImageFile($upload);
                $image->preUpdate(); // force doctrine to update.
            }

            $em->flush();
            $this->addFlash('success', 'Image has been updated.');

            return $this->redirectToRoute('artefact_show', array('id' => $artefact->getId()));
        }

        return array(
            'artefact' => $artefact,
            'image' => $image,
            'form' => $form->createView(),
        );
    }

    /**
     * Add an image to a artefact.
     *
     * @param Request $request
     * @param Artefact $artefact
     * @param Image $image
     *
     * @return RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/remove_image/{image_id}", name="artefact_remove_image", methods={"GET"})
     * @ParamConverter("image", options={"id" = "image_id"})
     */
    public function removeImage(Request $request, Artefact $artefact, Image $image, EntityManagerInterface $em) {
        if ($artefact->hasImage($image)) {
            $artefact->removeImage($image);
            $em->remove($image);
            $em->flush();
            $this->addFlash('success', 'The image has been removed.');
        } else {
            $this->addFlash('warning', 'The image was not removed.');
        }

        return $this->redirectToRoute('artefact_show', array('id' => $artefact->getId()));
    }
}
