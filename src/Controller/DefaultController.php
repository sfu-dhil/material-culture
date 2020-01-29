<?php

namespace App\Controller;

use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Nines\UtilBundle\Controller\PaginatorTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * @Route("/", name="homepage")
     * @Template()
     *
     * @param Request $request
     */
    public function indexAction(Request $request) {
        // replace this example code with whatever you need
        return array(
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        );
    }

    /**
     * @Route("/privacy", name="privacy")
     * @Template()
     *
     * @param Request $request
     *
     * @return array
     */
    public function privacyAction(Request $request) {
        return array();
    }
}
