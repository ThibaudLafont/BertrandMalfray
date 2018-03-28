<?php
namespace App\Controller;

use App\Entity\Project\Project;
use App\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

    /**
     * @Route(
     *     "/",
     *     name="homepage"
     * )
     */
    public function listAction(Request $request) {

        $form = $this->createForm('App\Form\Type\ContactType');

        $form->handleRequest($request);

        return $this->render(
            'default/homepage.html.twig',
            ['form' => $form->createView()]
        );

    }

}