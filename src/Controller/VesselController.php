<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Vessel;
use AppBundle\Form\VesselType;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Vessel controller.
 *
 * @Route("/vessel")
 */
class VesselController extends Controller implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all Vessel entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="vessel_index", methods={"GET"})
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Vessel::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $vessels = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'vessels' => $vessels,
        );
    }

    /**
     * Typeahead API endpoint for Vessel entities.
     *
     * To make this work, add something like this to VesselRepository:
     *
     * @param Request $request
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/typeahead", name="vessel_typeahead", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request) {
        $q = $request->query->get('q');
        if ( ! $q) {
            return new JsonResponse(array());
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Vessel::class);
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
     * Search for Vessel entities.
     *
     * To make this work, add a method like this one to the
     * AppBundle:Vessel repository. Replace the fieldName with
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
     * @Route("/search", name="vessel_search", methods={"GET"})
     * @Template()
     *
     * @return array
     */
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Vessel');
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $paginator = $this->get('knp_paginator');
            $vessels = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $vessels = array();
        }

        return array(
            'results' => $vessels,
            'q' => $q,
        );
    }

    /**
     * Creates a new Vessel entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new", name="vessel_new", methods={"GET","POST"})
     * @Template()
     */
    public function newAction(Request $request) {
        $vessel = new Vessel();
        $form = $this->createForm(VesselType::class, $vessel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vessel);
            $em->flush();

            $this->addFlash('success', 'The new vessel was created.');

            return $this->redirectToRoute('vessel_show', array('id' => $vessel->getId()));
        }

        return array(
            'vessel' => $vessel,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Vessel entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new_popup", name="vessel_new_popup", methods={"GET","POST"})
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Vessel entity.
     *
     * @param Vessel $vessel
     *
     * @return array
     *
     * @Route("/{id}", name="vessel_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Vessel $vessel) {
        return array(
            'vessel' => $vessel,
        );
    }

    /**
     * Displays a form to edit an existing Vessel entity.
     *
     * @param Request $request
     * @param Vessel $vessel
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/edit", name="vessel_edit", methods={"GET","POST"})
     * @Template()
     */
    public function editAction(Request $request, Vessel $vessel) {
        $editForm = $this->createForm(VesselType::class, $vessel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The vessel has been updated.');

            return $this->redirectToRoute('vessel_show', array('id' => $vessel->getId()));
        }

        return array(
            'vessel' => $vessel,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Vessel entity.
     *
     * @param Request $request
     * @param Vessel $vessel
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/delete", name="vessel_delete", methods={"GET"})
     */
    public function deleteAction(Request $request, Vessel $vessel) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($vessel);
        $em->flush();
        $this->addFlash('success', 'The vessel was deleted.');

        return $this->redirectToRoute('vessel_index');
    }
}
