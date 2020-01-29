<?php

namespace App\Controller;

use App\Entity\Image;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Nines\UtilBundle\Controller\PaginatorTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Image controller.
 *
 * @Route("/image")
 */
class ImageController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all Image entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="image_index", methods={"GET"})
     * @Template()
     */
    public function indexAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Image::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();

        $images = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'images' => $images,
        );
    }

    /**
     * Search for Image entities.
     *
     * To make this work, add a method like this one to the
     * App:Image repository. Replace the fieldName with
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
     * @Route("/search", name="image_search", methods={"GET"})
     * @Template()
     *
     * @return array
     */
    public function searchAction(Request $request, ImageRepository $repo) {
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $images = $this->paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $images = array();
        }

        return array(
            'images' => $images,
            'q' => $q,
        );
    }

    /**
     * Finds and displays a Image entity.
     *
     * @param Image $image
     *
     * @return array
     *
     * @Route("/{id}", name="image_show", methods={"GET"})
     * @Template()
     */
    public function showAction(Image $image) {
        return array(
            'image' => $image,
        );
    }

    /**
     * Finds and returns a raw image file.
     *
     * @param Image $image
     *
     * @Route("/{id}/view", name="image_view", methods={"GET"})
     *
     * @return BinaryFileResponse
     */
    public function imageAction(Image $image) {
        if ( ! $image->getPublic() && ! $this->getUser()) {
            throw new AccessDeniedHttpException();
        }

        return new BinaryFileResponse($image->getImageFile());
    }

    /**
     * Finds and returns a raw image file.
     *
     * @param Image $image
     *
     * @Route("/{id}/thumbnail", name="image_thumbnail", methods={"GET"})
     *
     * @return BinaryFileResponse
     */
    public function thumbnailAction(Image $image) {
        if ( ! $image->getPublic() && ! $this->getUser()) {
            throw new AccessDeniedHttpException();
        }

        return new BinaryFileResponse($image->getThumbnailFile());
    }
}
