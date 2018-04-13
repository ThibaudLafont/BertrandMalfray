<?php
namespace App\Controller;

use App\Entity\Project\Project;
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
        $projects = $em->getRepository(Project::class)
            ->findBy([], ['initDate' => 'DESC']);

        return $this->render(
            'project/list.html.twig',
            ['projects' => $projects]
        );

    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route(
     *     "/projects/{id}",
     *     name="project_show",
     *     requirements={"id"="\d+"}
     * )
     */
    public function showAction($id) {

        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('App:Project\Project')->find($id);

        return $this->render(
            'project/show.html.twig',
            ['project' => $project]
        );

    }

}
