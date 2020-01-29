<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Form\PublicationType;
use App\Repository\PublicationRepository;
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
 * Publication controller.
 *
 * @Route("/publication")
 */
class PublicationController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all Publication entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="publication_index", methods={"GET"})
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Publication::class, 'e')->orderBy('e.title', 'ASC');
        $query = $qb->getQuery();

        $publications = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'publications' => $publications,
        );
    }

    /**
     * Typeahead API endpoint for Publication entities.
     *
     * To make this work, add something like this to PublicationRepository:
     *
     * @param Request $request
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/typeahead", name="publication_typeahead", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request, PublicationRepository $repo) {
        $q = $request->query->get('q');
        if ( ! $q) {
            return new JsonResponse(array());
        }
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
     * Search for Publication entities.
     *
     * To make this work, add a method like this one to the
     * App:Publication repository. Replace the fieldName with
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
     * @Route("/search", name="publication_search", methods={"GET"})
     * @Template()
     *
     * @return array
     */
    public function searchAction(Request $request, PublicationRepository $repo) {
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $publications = $this->paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $publications = array();
        }

        return array(
            'results' => $publications,
            'q' => $q,
        );
    }

    /**
     * Creates a new Publication entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new", name="publication_new", methods={"GET","POST"})
     * @Template()
     */
    public function newAction(Request $request) {
        $publication = new Publication();
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $publication->setUrls(array_filter($form->get('urls')->getData()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($publication);
            $em->flush();

            $this->addFlash('success', 'The new publication was created.');

            return $this->redirectToRoute('publication_show', array('id' => $publication->getId()));
        }

        return array(
            'publication' => $publication,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Publication entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new_popup", name="publication_new_popup", methods={"GET","POST"})
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Publication entity.
     *
     * @param Publication $publication
     *
     * @return array
     *
     * @Route("/{id}", name="publication_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Publication $publication) {
        return array(
            'publication' => $publication,
        );
    }

    /**
     * Displays a form to edit an existing Publication entity.
     *
     * @param Request $request
     * @param Publication $publication
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/edit", name="publication_edit", methods={"GET","POST"})
     * @Template()
     */
    public function editAction(Request $request, Publication $publication) {
        $editForm = $this->createForm(PublicationType::class, $publication);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $publication->setUrls(array_filter($editForm->get('urls')->getData()));
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The publication has been updated.');

            return $this->redirectToRoute('publication_show', array('id' => $publication->getId()));
        }

        return array(
            'publication' => $publication,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Publication entity.
     *
     * @param Request $request
     * @param Publication $publication
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/delete", name="publication_delete", methods={"GET"})
     */
    public function deleteAction(Request $request, Publication $publication) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($publication);
        $em->flush();
        $this->addFlash('success', 'The publication was deleted.');

        return $this->redirectToRoute('publication_index');
    }
}
