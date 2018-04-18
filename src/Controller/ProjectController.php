<?php
namespace App\Controller;

use App\Entity\Project\HighConcept;
use App\Entity\Project\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     * @Route(
     *     "/project/{slugName}",
     *     name="project_show",
     *     requirements={"slugName"="(.+|-)+"}
     * )
     */
    public function showAction($slugName) {

        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('App:Project\Project')
            ->findOneBy(['slugName' => $slugName]);

        if(is_null($project)) {
            throw new NotFoundHttpException('Aucun projet ici...');
        }

        return $this->render(
            'project/show.html.twig',
            ['project' => $project]
        );

    }

    /**
     * @Route(
     *     "/bm-admin/project/create",
     *     name="project_create"
     * )
     */
    public function createAction(Request $request) {

        $form = $this->createForm('App\Form\Type\ProjectType');

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $project = new Project();
                $project->hydrate($form->getData());

                $em = $this->getDoctrine()->getManager();
                $em->persist($project);
                $em->flush();
            }
        }

        return $this->render(
            "admin/project/create.html.twig",
            ['form' => $form->createView()]
        );

    }

    /**
     * @Route(
     *     "/bm-admin/project/edit/{id}",
     *     name="project_edit"
     * )
     */
    public function editAction($id) {

        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('App:Project\Project')
            ->find($id);

        $form = $this->createForm('App\Form\Type\ProjectType', $project);

        return $this->render(
            "admin/project/create.html.twig",
            ['form' => $form->createView()]
        );

    }

}
