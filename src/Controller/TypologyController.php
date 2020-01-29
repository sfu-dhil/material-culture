<?php

namespace App\Controller;

use App\Entity\Typology;
use App\Form\TypologyType;
use App\Repository\TypologyRepository;
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
 * Typology controller.
 *
 * @Route("/typology")
 */
class TypologyController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all Typology entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="typology_index", methods={"GET"})
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Typology::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();

        $typologies = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'typologies' => $typologies,
        );
    }

    /**
     * Typeahead API endpoint for Typology entities.
     *
     * To make this work, add something like this to TypologyRepository:
     *
     * @param Request $request
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/typeahead", name="typology_typeahead", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request, TypologyRepository $repo) {
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
     * Search for Typology entities.
     *
     * To make this work, add a method like this one to the
     * App:Typology repository. Replace the fieldName with
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
     * @Route("/search", name="typology_search", methods={"GET"})
     * @Template()
     *
     * @return array
     */
    public function searchAction(Request $request, TypologyRepository $repo) {
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $typologies = $this->paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $typologies = array();
        }

        return array(
            'results' => $typologies,
            'q' => $q,
        );
    }

    /**
     * Creates a new Typology entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new", name="typology_new", methods={"GET","POST"})
     * @Template()
     */
    public function newAction(Request $request) {
        $typology = new Typology();
        $form = $this->createForm(TypologyType::class, $typology);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typology);
            $em->flush();

            $this->addFlash('success', 'The new typology was created.');

            return $this->redirectToRoute('typology_show', array('id' => $typology->getId()));
        }

        return array(
            'typology' => $typology,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Typology entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new_popup", name="typology_new_popup", methods={"GET","POST"})
     * @Template()
     */
    public function newPopupAction(Request $request, EntityManagerInterface $em) {
        return $this->newAction($request, $em);
    }

    /**
     * Finds and displays a Typology entity.
     *
     * @param Typology $typology
     *
     * @return array
     *
     * @Route("/{id}", name="typology_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Typology $typology) {
        return array(
            'typology' => $typology,
        );
    }

    /**
     * Displays a form to edit an existing Typology entity.
     *
     * @param Request $request
     * @param Typology $typology
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/edit", name="typology_edit", methods={"GET","POST"})
     * @Template()
     */
    public function editAction(Request $request, Typology $typology) {
        $editForm = $this->createForm(TypologyType::class, $typology);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The typology has been updated.');

            return $this->redirectToRoute('typology_show', array('id' => $typology->getId()));
        }

        return array(
            'typology' => $typology,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Typology entity.
     *
     * @param Request $request
     * @param Typology $typology
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/delete", name="typology_delete", methods={"GET"})
     */
    public function deleteAction(Request $request, Typology $typology) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($typology);
        $em->flush();
        $this->addFlash('success', 'The typology was deleted.');

        return $this->redirectToRoute('typology_index');
    }
}
