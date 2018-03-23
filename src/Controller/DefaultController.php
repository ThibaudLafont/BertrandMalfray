<?php
namespace App\Controller;

use App\Entity\Project\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

    /**
     * @Route(
     *     "/",
     *     name="homepage"
     * )
     */
    public function listAction() {

        return $this->render(
            'default/homepage.html.twig'
        );

    }

}