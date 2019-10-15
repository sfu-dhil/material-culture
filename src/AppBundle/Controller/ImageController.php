<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Image;
use AppBundle\Form\ImageType;

/**
 * Image controller.
 *
 * @IsGranted("ROLE_USER")
 * @Route("/image")
 */
class ImageController extends Controller implements PaginatorAwareInterface
{
    use PaginatorTrait;

    /**
     * Lists all Image entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="image_index", methods={"GET"})
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Image::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $images = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'images' => $images,
        );
    }

/**
     * Typeahead API endpoint for Image entities.
     *
     * To make this work, add something like this to ImageRepository:
        //    public function typeaheadQuery($q) {
        //        $qb = $this->createQueryBuilder('e');
        //        $qb->andWhere("e.name LIKE :q");
        //        $qb->orderBy('e.name');
        //        $qb->setParameter('q', "{$q}%");
        //        return $qb->getQuery()->execute();
        //    }
     *
     * @param Request $request
     *
     * @Route("/typeahead", name="image_typeahead", methods={"GET"})
     * @return JsonResponse
     */
    public function typeahead(Request $request)
    {
        $q = $request->query->get('q');
        if( ! $q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
	    $repo = $em->getRepository(Image::class);
        $data = [];
        foreach($repo->typeaheadQuery($q) as $result) {
            $data[] = [
                'id' => $result->getId(),
                'text' => (string)$result,
            ];
        }
        return new JsonResponse($data);
    }
    /**
     * Search for Image entities.
     *
     * To make this work, add a method like this one to the
     * AppBundle:Image repository. Replace the fieldName with
     * something appropriate, and adjust the generated search.html.twig
     * template.
     *
     * <code><pre>
     *    public function searchQuery($q) {
     *       $qb = $this->createQueryBuilder('e');
     *       $qb->addSelect("MATCH (e.title) AGAINST(:q BOOLEAN) as HIDDEN score");
     *       $qb->orderBy('score', 'DESC');
     *       $qb->setParameter('q', $q);
     *       return $qb->getQuery();
     *    }
     * </pre></code>
     *
     * @param Request $request
     *
     * @Route("/search", name="image_search", methods={"GET"})
     * @Template()
    * @return array
    */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
	$repo = $em->getRepository('AppBundle:Image');
	$q = $request->query->get('q');
	if($q) {
	    $query = $repo->searchQuery($q);
            $paginator = $this->get('knp_paginator');
            $images = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
	} else {
            $images = array();
	}

        return array(
            'images' => $images,
            'q' => $q,
        );
    }

    /**
     * Creates a new Image entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new", name="image_new", methods={"GET","POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            $this->addFlash('success', 'The new image was created.');
            return $this->redirectToRoute('image_show', array('id' => $image->getId()));
        }

        return array(
            'image' => $image,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Image entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new_popup", name="image_new_popup", methods={"GET","POST"})
     * @Template()
     */
    public function newPopupAction(Request $request)
    {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Image entity.
     *
     * @param Image $image
     *
     * @return array
     *
     * @Route("/{id}", name="image_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Image $image)
    {

        return array(
            'image' => $image,
        );
    }

    /**
     * Displays a form to edit an existing Image entity.
     *
     *
     * @param Request $request
     * @param Image $image
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/edit", name="image_edit", methods={"GET","POST"})
     * @Template()
     */
    public function editAction(Request $request, Image $image)
    {
        $editForm = $this->createForm(ImageType::class, $image);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The image has been updated.');
            return $this->redirectToRoute('image_show', array('id' => $image->getId()));
        }

        return array(
            'image' => $image,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Image entity.
     *
     *
     * @param Request $request
     * @param Image $image
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/delete", name="image_delete", methods={"GET"})
     */
    public function deleteAction(Request $request, Image $image)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($image);
        $em->flush();
        $this->addFlash('success', 'The image was deleted.');

        return $this->redirectToRoute('image_index');
    }
}
