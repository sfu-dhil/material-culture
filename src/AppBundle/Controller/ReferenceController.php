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
use AppBundle\Entity\Reference;
use AppBundle\Form\ReferenceType;

/**
 * Reference controller.
 *
 * @IsGranted("ROLE_USER")
 * @Route("/reference")
 */
class ReferenceController extends Controller implements PaginatorAwareInterface
{
    use PaginatorTrait;

    /**
     * Lists all Reference entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="reference_index", methods={"GET"})
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Reference::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $references = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'references' => $references,
        );
    }

/**
     * Typeahead API endpoint for Reference entities.
     *
     * To make this work, add something like this to ReferenceRepository:
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
     * @Route("/typeahead", name="reference_typeahead", methods={"GET"})
     * @return JsonResponse
     */
    public function typeahead(Request $request)
    {
        $q = $request->query->get('q');
        if( ! $q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
	    $repo = $em->getRepository(Reference::class);
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
     * Search for Reference entities.
     *
     * To make this work, add a method like this one to the
     * AppBundle:Reference repository. Replace the fieldName with
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
     * @Route("/search", name="reference_search", methods={"GET"})
     * @Template()
    * @return array
    */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
	$repo = $em->getRepository('AppBundle:Reference');
	$q = $request->query->get('q');
	if($q) {
	    $query = $repo->searchQuery($q);
            $paginator = $this->get('knp_paginator');
            $references = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
	} else {
            $references = array();
	}

        return array(
            'references' => $references,
            'q' => $q,
        );
    }

    /**
     * Creates a new Reference entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new", name="reference_new", methods={"GET","POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $reference = new Reference();
        $form = $this->createForm(ReferenceType::class, $reference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reference);
            $em->flush();

            $this->addFlash('success', 'The new reference was created.');
            return $this->redirectToRoute('reference_show', array('id' => $reference->getId()));
        }

        return array(
            'reference' => $reference,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Reference entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new_popup", name="reference_new_popup", methods={"GET","POST"})
     * @Template()
     */
    public function newPopupAction(Request $request)
    {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Reference entity.
     *
     * @param Reference $reference
     *
     * @return array
     *
     * @Route("/{id}", name="reference_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Reference $reference)
    {

        return array(
            'reference' => $reference,
        );
    }

    /**
     * Displays a form to edit an existing Reference entity.
     *
     *
     * @param Request $request
     * @param Reference $reference
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/edit", name="reference_edit", methods={"GET","POST"})
     * @Template()
     */
    public function editAction(Request $request, Reference $reference)
    {
        $editForm = $this->createForm(ReferenceType::class, $reference);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The reference has been updated.');
            return $this->redirectToRoute('reference_show', array('id' => $reference->getId()));
        }

        return array(
            'reference' => $reference,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Reference entity.
     *
     *
     * @param Request $request
     * @param Reference $reference
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/delete", name="reference_delete", methods={"GET"})
     */
    public function deleteAction(Request $request, Reference $reference)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($reference);
        $em->flush();
        $this->addFlash('success', 'The reference was deleted.');

        return $this->redirectToRoute('reference_index');
    }
}
