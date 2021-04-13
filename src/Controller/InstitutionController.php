<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\Institution;
use App\Form\InstitutionType;
use App\Repository\InstitutionRepository;
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
 * Institution controller.
 *
 * @Route("/institution")
 */
class InstitutionController extends AbstractController implements PaginatorAwareInterface
{
    use PaginatorTrait;

    /**
     * Lists all Institution entities.
     *
     * @return array
     *
     * @Route("/", name="institution_index", methods={"GET"})
     * @Template
     */
    public function indexAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Institution::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();

        $institutions = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return [
            'institutions' => $institutions,
        ];
    }

    /**
     * Typeahead API endpoint for Institution entities.
     *
     * To make this work, add something like this to InstitutionRepository:
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/typeahead", name="institution_typeahead", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request, InstitutionRepository $repo) {
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
     * Search for Institution entities.
     *
     * To make this work, add a method like this one to the
     * App:Institution repository. Replace the fieldName with
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
     * @Route("/search", name="institution_search", methods={"GET"})
     * @Template
     *
     * @return array
     */
    public function searchAction(Request $request, InstitutionRepository $repo) {
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $institutions = $this->paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $institutions = [];
        }

        return [
            'results' => $institutions,
            'q' => $q,
        ];
    }

    /**
     * Creates a new Institution entity.
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new", name="institution_new", methods={"GET", "POST"})
     * @Template
     */
    public function newAction(Request $request, EntityManagerInterface $em) {
        $institution = new Institution();
        $form = $this->createForm(InstitutionType::class, $institution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($institution);
            $em->flush();

            $this->addFlash('success', 'The new institution was created.');

            return $this->redirectToRoute('institution_show', ['id' => $institution->getId()]);
        }

        return [
            'institution' => $institution,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a new Institution entity in a popup.
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new_popup", name="institution_new_popup", methods={"GET", "POST"})
     * @Template
     */
    public function newPopupAction(Request $request, EntityManagerInterface $em) {
        return $this->newAction($request, $em);
    }

    /**
     * Finds and displays a Institution entity.
     *
     * @return array
     *
     * @Route("/{id}", name="institution_show", methods={"GET"})
     * @Template
     */
    public function showAction(Institution $institution) {
        return [
            'institution' => $institution,
        ];
    }

    /**
     * Displays a form to edit an existing Institution entity.
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/edit", name="institution_edit", methods={"GET", "POST"})
     * @Template
     */
    public function editAction(Request $request, Institution $institution, EntityManagerInterface $em) {
        $editForm = $this->createForm(InstitutionType::class, $institution);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'The institution has been updated.');

            return $this->redirectToRoute('institution_show', ['id' => $institution->getId()]);
        }

        return [
            'institution' => $institution,
            'edit_form' => $editForm->createView(),
        ];
    }

    /**
     * Deletes a Institution entity.
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/delete", name="institution_delete", methods={"GET"})
     */
    public function deleteAction(Request $request, Institution $institution, EntityManagerInterface $em) {
        $em->remove($institution);
        $em->flush();
        $this->addFlash('success', 'The institution was deleted.');

        return $this->redirectToRoute('institution_index');
    }
}
