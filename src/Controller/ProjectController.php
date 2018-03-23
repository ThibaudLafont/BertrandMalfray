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
        $projects = $em->getRepository('App:Project\Project')->findAll();

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
     *     name="project_show"
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

    /**
     * @param $category
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route(
     *     "/{catName}/projects",
     *     name="projects_by_category"
     * )
     */
    public function listByCategoryAction($catName) {

        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository(Project::class)
            ->findByNewTime(['cat_name' => $catName]);

        return $this->render(
            'project/list.html.twig',
            ['projects' => $projects]
        );

    }

}