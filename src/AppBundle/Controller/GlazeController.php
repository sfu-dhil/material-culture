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
use AppBundle\Entity\Glaze;
use AppBundle\Form\GlazeType;

/**
 * Glaze controller.
 *
 * @IsGranted("ROLE_USER")
 * @Route("/glaze")
 */
class GlazeController extends Controller implements PaginatorAwareInterface
{
    use PaginatorTrait;

    /**
     * Lists all Glaze entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="glaze_index", methods={"GET"})
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Glaze::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $glazes = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'glazes' => $glazes,
        );
    }

/**
     * Typeahead API endpoint for Glaze entities.
     *
     * To make this work, add something like this to GlazeRepository:
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
     * @Route("/typeahead", name="glaze_typeahead", methods={"GET"})
     * @return JsonResponse
     */
    public function typeahead(Request $request)
    {
        $q = $request->query->get('q');
        if( ! $q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
	    $repo = $em->getRepository(Glaze::class);
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
     * Search for Glaze entities.
     *
     * To make this work, add a method like this one to the
     * AppBundle:Glaze repository. Replace the fieldName with
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
     * @Route("/search", name="glaze_search", methods={"GET"})
     * @Template()
    * @return array
    */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
	$repo = $em->getRepository('AppBundle:Glaze');
	$q = $request->query->get('q');
	if($q) {
	    $query = $repo->searchQuery($q);
            $paginator = $this->get('knp_paginator');
            $glazes = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
	} else {
            $glazes = array();
	}

        return array(
            'glazes' => $glazes,
            'q' => $q,
        );
    }

    /**
     * Creates a new Glaze entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new", name="glaze_new", methods={"GET","POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $glaze = new Glaze();
        $form = $this->createForm(GlazeType::class, $glaze);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($glaze);
            $em->flush();

            $this->addFlash('success', 'The new glaze was created.');
            return $this->redirectToRoute('glaze_show', array('id' => $glaze->getId()));
        }

        return array(
            'glaze' => $glaze,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Glaze entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new_popup", name="glaze_new_popup", methods={"GET","POST"})
     * @Template()
     */
    public function newPopupAction(Request $request)
    {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Glaze entity.
     *
     * @param Glaze $glaze
     *
     * @return array
     *
     * @Route("/{id}", name="glaze_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Glaze $glaze)
    {

        return array(
            'glaze' => $glaze,
        );
    }

    /**
     * Displays a form to edit an existing Glaze entity.
     *
     *
     * @param Request $request
     * @param Glaze $glaze
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/edit", name="glaze_edit", methods={"GET","POST"})
     * @Template()
     */
    public function editAction(Request $request, Glaze $glaze)
    {
        $editForm = $this->createForm(GlazeType::class, $glaze);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The glaze has been updated.');
            return $this->redirectToRoute('glaze_show', array('id' => $glaze->getId()));
        }

        return array(
            'glaze' => $glaze,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Glaze entity.
     *
     *
     * @param Request $request
     * @param Glaze $glaze
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/delete", name="glaze_delete", methods={"GET"})
     */
    public function deleteAction(Request $request, Glaze $glaze)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($glaze);
        $em->flush();
        $this->addFlash('success', 'The glaze was deleted.');

        return $this->redirectToRoute('glaze_index');
    }
}
