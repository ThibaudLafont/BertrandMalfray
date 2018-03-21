<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends Controller
{

    /**
     * @Route(
     *     "/projects",
     *     name="project_list"
     * )
     */
    public function listAction() {

        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository('App:Project')->findAll();

        $this->render(
            'App:Project/list.html.twig',
            ['projects' => $projects]
        );

    }
    public function showAction() {}

}