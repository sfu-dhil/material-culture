<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\Manufacturer;
use App\Form\ManufacturerType;
use App\Repository\ManufacturerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Nines\UtilBundle\Controller\PaginatorTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Manufacturer controller.
 *
 * @Route("/manufacturer")
 */
class ManufacturerController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all Manufacturer entities.
     *
     * @return array
     *
     * @Route("/", name="manufacturer_index", methods={"GET"})
     * @Template
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Manufacturer::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();

        $manufacturers = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return [
            'manufacturers' => $manufacturers,
        ];
    }

    /**
     * Typeahead API endpoint for Manufacturer entities.
     *
     * To make this work, add something like this to ManufacturerRepository:
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/typeahead", name="manufacturer_typeahead", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request, ManufacturerRepository $repo) {
        $q = $request->query->get('q');
        if ( ! $q) {
            return new JsonResponse([]);
        }
        $data = [];

        foreach ($repo->typeaheadQuery($q) as $result) {
            $data[] = [
                'id' => $result->getId(),
                'text' => (string) $result,
            ];
        }

        return new JsonResponse($data);
    }

    /**
     * Search for Manufacturer entities.
     *
     * To make this work, add a method like this one to the
     * App:Manufacturer repository. Replace the fieldName with
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
     * @Route("/search", name="manufacturer_search", methods={"GET"})
     * @Template
     *
     * @return array
     */
    public function searchAction(Request $request, ManufacturerRepository $repo) {
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $manufacturers = $this->paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $manufacturers = [];
        }

        return [
            'results' => $manufacturers,
            'q' => $q,
        ];
    }

    /**
     * Creates a new Manufacturer entity.
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new", name="manufacturer_new", methods={"GET", "POST"})
     * @Template
     */
    public function newAction(Request $request) {
        $manufacturer = new Manufacturer();
        $form = $this->createForm(ManufacturerType::class, $manufacturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($manufacturer);
            $em->flush();

            $this->addFlash('success', 'The new manufacturer was created.');

            return $this->redirectToRoute('manufacturer_show', ['id' => $manufacturer->getId()]);
        }

        return [
            'manufacturer' => $manufacturer,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a new Manufacturer entity in a popup.
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new_popup", name="manufacturer_new_popup", methods={"GET", "POST"})
     * @Template
     */
    public function newPopupAction(Request $request, EntityManagerInterface $em) {
        return $this->newAction($request, $em);
    }

    /**
     * Finds and displays a Manufacturer entity.
     *
     * @return array
     *
     * @Route("/{id}", name="manufacturer_show", methods={"GET"})
     * @Template
     */
    public function showAction(Manufacturer $manufacturer) {
        return [
            'manufacturer' => $manufacturer,
        ];
    }

    /**
     * Displays a form to edit an existing Manufacturer entity.
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/edit", name="manufacturer_edit", methods={"GET", "POST"})
     * @Template
     */
    public function editAction(Request $request, Manufacturer $manufacturer) {
        $editForm = $this->createForm(ManufacturerType::class, $manufacturer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The manufacturer has been updated.');

            return $this->redirectToRoute('manufacturer_show', ['id' => $manufacturer->getId()]);
        }

        return [
            'manufacturer' => $manufacturer,
            'edit_form' => $editForm->createView(),
        ];
    }

    /**
     * Deletes a Manufacturer entity.
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/delete", name="manufacturer_delete", methods={"GET"})
     */
    public function deleteAction(Request $request, Manufacturer $manufacturer) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($manufacturer);
        $em->flush();
        $this->addFlash('success', 'The manufacturer was deleted.');

        return $this->redirectToRoute('manufacturer_index');
    }
}
