<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Shape;
use AppBundle\Form\ShapeType;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Shape controller.
 *
 * @IsGranted("ROLE_USER")
 * @Route("/shape")
 */
class ShapeController extends Controller implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all Shape entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="shape_index", methods={"GET"})
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Shape::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $shapes = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'shapes' => $shapes,
        );
    }

    /**
     * Typeahead API endpoint for Shape entities.
     *
     * To make this work, add something like this to ShapeRepository:
     *
     * @param Request $request
     *
     * @Route("/typeahead", name="shape_typeahead", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request) {
        $q = $request->query->get('q');
        if ( ! $q) {
            return new JsonResponse(array());
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Shape::class);
        $data = array();
        foreach ($repo->typeaheadQuery($q) as $result) {
            $data[] = array(
                'id' => $result->getId(),
                'text' => (string) $result,
            );
        }

        return new JsonResponse($data);
    }

    /**
     * Search for Shape entities.
     *
     * To make this work, add a method like this one to the
     * AppBundle:Shape repository. Replace the fieldName with
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
     * @Route("/search", name="shape_search", methods={"GET"})
     * @Template()
     *
     * @return array
     */
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Shape');
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $paginator = $this->get('knp_paginator');
            $shapes = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $shapes = array();
        }

        return array(
            'shapes' => $shapes,
            'q' => $q,
        );
    }

    /**
     * Creates a new Shape entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new", name="shape_new", methods={"GET","POST"})
     * @Template()
     */
    public function newAction(Request $request) {
        $shape = new Shape();
        $form = $this->createForm(ShapeType::class, $shape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shape);
            $em->flush();

            $this->addFlash('success', 'The new shape was created.');

            return $this->redirectToRoute('shape_show', array('id' => $shape->getId()));
        }

        return array(
            'shape' => $shape,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Shape entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new_popup", name="shape_new_popup", methods={"GET","POST"})
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Shape entity.
     *
     * @param Shape $shape
     *
     * @return array
     *
     * @Route("/{id}", name="shape_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Shape $shape) {
        return array(
            'shape' => $shape,
        );
    }

    /**
     * Displays a form to edit an existing Shape entity.
     *
     * @param Request $request
     * @param Shape $shape
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/edit", name="shape_edit", methods={"GET","POST"})
     * @Template()
     */
    public function editAction(Request $request, Shape $shape) {
        $editForm = $this->createForm(ShapeType::class, $shape);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The shape has been updated.');

            return $this->redirectToRoute('shape_show', array('id' => $shape->getId()));
        }

        return array(
            'shape' => $shape,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Shape entity.
     *
     * @param Request $request
     * @param Shape $shape
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/delete", name="shape_delete", methods={"GET"})
     */
    public function deleteAction(Request $request, Shape $shape) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($shape);
        $em->flush();
        $this->addFlash('success', 'The shape was deleted.');

        return $this->redirectToRoute('shape_index');
    }
}
