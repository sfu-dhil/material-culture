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
use AppBundle\Entity\Can;
use AppBundle\Form\CanType;

/**
 * Can controller.
 *
 * @IsGranted("ROLE_USER")
 * @Route("/can")
 */
class CanController extends Controller implements PaginatorAwareInterface
{
    use PaginatorTrait;

    /**
     * Lists all Can entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="can_index", methods={"GET"})
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Can::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $cans = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'cans' => $cans,
        );
    }

/**
     * Typeahead API endpoint for Can entities.
     *
     * To make this work, add something like this to CanRepository:
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
     * @Route("/typeahead", name="can_typeahead", methods={"GET"})
     * @return JsonResponse
     */
    public function typeahead(Request $request)
    {
        $q = $request->query->get('q');
        if( ! $q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
	    $repo = $em->getRepository(Can::class);
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
     * Search for Can entities.
     *
     * To make this work, add a method like this one to the
     * AppBundle:Can repository. Replace the fieldName with
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
     * @Route("/search", name="can_search", methods={"GET"})
     * @Template()
    * @return array
    */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
	$repo = $em->getRepository('AppBundle:Can');
	$q = $request->query->get('q');
	if($q) {
	    $query = $repo->searchQuery($q);
            $paginator = $this->get('knp_paginator');
            $cans = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
	} else {
            $cans = array();
	}

        return array(
            'cans' => $cans,
            'q' => $q,
        );
    }

    /**
     * Creates a new Can entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new", name="can_new", methods={"GET","POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $can = new Can();
        $form = $this->createForm(CanType::class, $can);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($can);
            $em->flush();

            $this->addFlash('success', 'The new can was created.');
            return $this->redirectToRoute('can_show', array('id' => $can->getId()));
        }

        return array(
            'can' => $can,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Can entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new_popup", name="can_new_popup", methods={"GET","POST"})
     * @Template()
     */
    public function newPopupAction(Request $request)
    {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Can entity.
     *
     * @param Can $can
     *
     * @return array
     *
     * @Route("/{id}", name="can_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Can $can)
    {

        return array(
            'can' => $can,
        );
    }

    /**
     * Displays a form to edit an existing Can entity.
     *
     *
     * @param Request $request
     * @param Can $can
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/edit", name="can_edit", methods={"GET","POST"})
     * @Template()
     */
    public function editAction(Request $request, Can $can)
    {
        $editForm = $this->createForm(CanType::class, $can);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The can has been updated.');
            return $this->redirectToRoute('can_show', array('id' => $can->getId()));
        }

        return array(
            'can' => $can,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Can entity.
     *
     *
     * @param Request $request
     * @param Can $can
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/delete", name="can_delete", methods={"GET"})
     */
    public function deleteAction(Request $request, Can $can)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($can);
        $em->flush();
        $this->addFlash('success', 'The can was deleted.');

        return $this->redirectToRoute('can_index');
    }
}
