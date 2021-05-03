<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\Reference;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Nines\UtilBundle\Controller\PaginatorTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Reference controller.
 *
 * @Route("/reference")
 */
class ReferenceController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all Reference entities.
     *
     * @return array
     *
     * @Route("/", name="reference_index", methods={"GET"})
     * @Template
     */
    public function indexAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Reference::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();

        $references = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return [
            'references' => $references,
        ];
    }

    /**
     * Finds and displays a Reference entity.
     *
     * @return array
     *
     * @Route("/{id}", name="reference_show", methods={"GET"})
     * @Template
     */
    public function showAction(Reference $reference) {
        return [
            'reference' => $reference,
        ];
    }
}
