<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\Ceramic;
use App\Form\CeramicType;
use App\Repository\CeramicRepository;
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
 * Ceramic controller.
 *
 * @Route("/ceramic")
 */
class CeramicController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all Ceramic entities.
     *
     * @return array
     *
     * @Route("/", name="ceramic_index", methods={"GET"})
     * @Template()
     */
    public function indexAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Ceramic::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();

        $ceramics = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return [
            'ceramics' => $ceramics,
        ];
    }

    /**
     * Search for Ceramic entities.
     *
     * To make this work, add a method like this one to the
     * App:Ceramic repository. Replace the fieldName with
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
     * @Route("/search", name="ceramic_search", methods={"GET"})
     * @Template()
     *
     * @return array
     */
    public function searchAction(Request $request, CeramicRepository $repo) {
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $ceramics = $this->paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $ceramics = [];
        }

        return [
            'ceramics' => $ceramics,
            'q' => $q,
        ];
    }

    /**
     * Creates a new Ceramic entity.
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/new", name="ceramic_new", methods={"GET","POST"})
     * @Template()
     */
    public function newAction(Request $request, EntityManagerInterface $em) {
        $ceramic = new Ceramic();
        $form = $this->createForm(CeramicType::class, $ceramic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ceramic);
            $em->flush();

            $this->addFlash('success', 'The new ceramic was created.');

            return $this->redirectToRoute('ceramic_show', ['id' => $ceramic->getId()]);
        }

        return [
            'ceramic' => $ceramic,
            'form' => $form->createView(),
        ];
    }

    /**
     * Finds and displays a Ceramic entity.
     *
     * @return array
     *
     * @Route("/{id}", name="ceramic_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Request $request, Ceramic $ceramic) {
        $images = $this->paginator->paginate($ceramic->getImages(), $request->query->getint('page', 1), 25);

        return [
            'ceramic' => $ceramic,
            'images' => $images,
        ];
    }

    /**
     * Displays a form to edit an existing Ceramic entity.
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/edit", name="ceramic_edit", methods={"GET","POST"})
     * @Template()
     */
    public function editAction(Request $request, Ceramic $ceramic, EntityManagerInterface $em) {
        $editForm = $this->createForm(CeramicType::class, $ceramic);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'The ceramic has been updated.');

            return $this->redirectToRoute('ceramic_show', ['id' => $ceramic->getId()]);
        }

        return [
            'ceramic' => $ceramic,
            'edit_form' => $editForm->createView(),
        ];
    }

    /**
     * Deletes a Ceramic entity.
     *
     * @return array|RedirectResponse
     *
     * @IsGranted("ROLE_CONTENT_ADMIN")
     * @Route("/{id}/delete", name="ceramic_delete", methods={"GET"})
     */
    public function deleteAction(Request $request, Ceramic $ceramic, EntityManagerInterface $em) {
        $em->remove($ceramic);
        $em->flush();
        $this->addFlash('success', 'The ceramic was deleted.');

        return $this->redirectToRoute('ceramic_index');
    }
}
