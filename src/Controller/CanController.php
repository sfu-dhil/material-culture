<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Can;
use AppBundle\Form\CanType;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Can controller.
 *
 * @Route("/can")
 */
class CanController extends Controller implements PaginatorAwareInterface {
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
    public function indexAction(Request $request) {
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
     *
     * @return array
     */
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Can');
        $q = $request->query->get('q');
        if ($q) {
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
    public function newAction(Request $request) {
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
     * Finds and displays a Can entity.
     *
     * @param Request $request
     * @param Can $can
     *
     * @return array
     *
     * @Route("/{id}", name="can_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Request $request, Can $can) {
        $images = $this->paginator->paginate($can->getImages(), $request->query->getint('page', 1), 25);

        return array(
            'can' => $can,
            'images' => $images,
        );
    }

    /**
     * Displays a form to edit an existing Can entity.
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
    public function editAction(Request $request, Can $can) {
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
     * @param Request $request
     * @param Can $can
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/delete", name="can_delete", methods={"GET"})
     */
    public function deleteAction(Request $request, Can $can) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($can);
        $em->flush();
        $this->addFlash('success', 'The can was deleted.');

        return $this->redirectToRoute('can_index');
    }
}
