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
use AppBundle\Entity\Bottle;
use AppBundle\Form\BottleType;

/**
 * Bottle controller.
 *
 * @IsGranted("ROLE_USER")
 * @Route("/bottle")
 */
class BottleController extends Controller implements PaginatorAwareInterface
{
    use PaginatorTrait;

    /**
     * Lists all Bottle entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="bottle_index", methods={"GET"})
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Bottle::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $bottles = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'bottles' => $bottles,
        );
    }

/**
     * Typeahead API endpoint for Bottle entities.
     *
     * To make this work, add something like this to BottleRepository:
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
     * @Route("/typeahead", name="bottle_typeahead", methods={"GET"})
     * @return JsonResponse
     */
    public function typeahead(Request $request)
    {
        $q = $request->query->get('q');
        if( ! $q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
	    $repo = $em->getRepository(Bottle::class);
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
     * Search for Bottle entities.
     *
     * To make this work, add a method like this one to the
     * AppBundle:Bottle repository. Replace the fieldName with
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
     * @Route("/search", name="bottle_search", methods={"GET"})
     * @Template()
    * @return array
    */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
	$repo = $em->getRepository('AppBundle:Bottle');
	$q = $request->query->get('q');
	if($q) {
	    $query = $repo->searchQuery($q);
            $paginator = $this->get('knp_paginator');
            $bottles = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
	} else {
            $bottles = array();
	}

        return array(
            'bottles' => $bottles,
            'q' => $q,
        );
    }

    /**
     * Creates a new Bottle entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new", name="bottle_new", methods={"GET","POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $bottle = new Bottle();
        $form = $this->createForm(BottleType::class, $bottle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bottle);
            $em->flush();

            $this->addFlash('success', 'The new bottle was created.');
            return $this->redirectToRoute('bottle_show', array('id' => $bottle->getId()));
        }

        return array(
            'bottle' => $bottle,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Bottle entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new_popup", name="bottle_new_popup", methods={"GET","POST"})
     * @Template()
     */
    public function newPopupAction(Request $request)
    {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Bottle entity.
     *
     * @param Bottle $bottle
     *
     * @return array
     *
     * @Route("/{id}", name="bottle_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Bottle $bottle)
    {

        return array(
            'bottle' => $bottle,
        );
    }

    /**
     * Displays a form to edit an existing Bottle entity.
     *
     *
     * @param Request $request
     * @param Bottle $bottle
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/edit", name="bottle_edit", methods={"GET","POST"})
     * @Template()
     */
    public function editAction(Request $request, Bottle $bottle)
    {
        $editForm = $this->createForm(BottleType::class, $bottle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The bottle has been updated.');
            return $this->redirectToRoute('bottle_show', array('id' => $bottle->getId()));
        }

        return array(
            'bottle' => $bottle,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Bottle entity.
     *
     *
     * @param Request $request
     * @param Bottle $bottle
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/delete", name="bottle_delete", methods={"GET"})
     */
    public function deleteAction(Request $request, Bottle $bottle)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($bottle);
        $em->flush();
        $this->addFlash('success', 'The bottle was deleted.');

        return $this->redirectToRoute('bottle_index');
    }
}
