<?php
namespace App\Controller;

use App\Entity\Project\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardAction() {

        return $this->render('admin/dashboard.html.twig');

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listProjectsAction() {

        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository(Project::class)
            ->findBy([], ['name' => 'ASC']);

        return $this->render(
            'admin/project/list.html.twig',
            ['projects' => $projects]
        );

    }

}
