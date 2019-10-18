<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Reference;
use AppBundle\Form\ReferenceType;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Reference controller.
 *
 * @IsGranted("ROLE_USER")
 * @Route("/reference")
 */
class ReferenceController extends Controller implements PaginatorAwareInterface {
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
    public function indexAction(Request $request) {
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
     * Finds and displays a Reference entity.
     *
     * @param Reference $reference
     *
     * @return array
     *
     * @Route("/{id}", name="reference_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Reference $reference) {
        return array(
            'reference' => $reference,
        );
    }
}
