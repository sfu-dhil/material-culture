<?php

namespace App\Controller;

use App\Entity\Bottle;
use App\Form\BottleType;
use App\Repository\BottleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Nines\UtilBundle\Controller\PaginatorTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Bottle controller.
 *
 * @Route("/bottle")
 */
class BottleController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all Bottle entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="bottle_index", methods={"GET"})
     * @Template()
     */
    public function indexAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Bottle::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();

        $bottles = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'bottles' => $bottles,
        );
    }

    /**
     * Search for Bottle entities.
     *
     * To make this work, add a method like this one to the
     * App:Bottle repository. Replace the fieldName with
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
     * @Route("/search", name="bottle_search", methods={"GET"})
     * @Template()
     *
     * @return array
     */
    public function searchAction(Request $request, BottleRepository $repo) {
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $bottles = $this->paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $bottles = array();
        }

        return array(
            'bottles' => $bottles,
            'q' => $q,
        );
    }

    /**
     * Creates a new Bottle entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new", name="bottle_new", methods={"GET","POST"})
     * @Template()
     */
    public function newAction(Request $request, EntityManagerInterface $em) {
        $bottle = new Bottle();
        $form = $this->createForm(BottleType::class, $bottle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($bottle->getReferences() as $reference) {
                $reference->setArtefact($bottle);
            }
            $em->persist($bottle);
            $em->flush();

            $this->addFlash('success', 'The new bottle was created.');

            return $this->redirectToRoute('bottle_show', array('id' => $bottle->getId()));
        }

        return array(
            'bottle' => $bottle,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Bottle entity.
     *
     * @param Request $request
     * @param Bottle $bottle
     *
     * @return array
     *
     * @Route("/{id}", name="bottle_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Request $request, Bottle $bottle) {
        $images = $this->paginator->paginate($bottle->getImages(), $request->query->getint('page', 1), 25);

        return array(
            'bottle' => $bottle,
            'images' => $images,
        );
    }

    /**
     * Displays a form to edit an existing Bottle entity.
     *
     * @param Request $request
     * @param Bottle $bottle
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/edit", name="bottle_edit", methods={"GET","POST"})
     * @Template()
     */
    public function editAction(Request $request, Bottle $bottle, EntityManagerInterface $em) {
        $editForm = $this->createForm(BottleType::class, $bottle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'The bottle has been updated.');

            return $this->redirectToRoute('bottle_show', array('id' => $bottle->getId()));
        }

        return array(
            'bottle' => $bottle,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Bottle entity.
     *
     * @param Request $request
     * @param Bottle $bottle
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/delete", name="bottle_delete", methods={"GET"})
     */
    public function deleteAction(Request $request, Bottle $bottle, EntityManagerInterface $em) {
        $em->remove($bottle);
        $em->flush();
        $this->addFlash('success', 'The bottle was deleted.');

        return $this->redirectToRoute('bottle_index');
    }
}
