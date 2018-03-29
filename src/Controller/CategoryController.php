<?php
namespace App\Controller;

use App\Entity\Project\Category;
use App\Entity\Project\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends Controller
{

    /**
     * @Route(
     *     "/projects/{cat}",
     *     name="category_projects",
     *     requirements={
     *          "cat"="([a-z]+|-)+"
     *     }
     * )
     */
    public function listProjectsAction($cat) {

        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository(Category::class)
            ->findOneBy(
                ['slugName' => $cat]
            );

        $projects = $cat->getProjects();

        return $this->render(
            'project/category.html.twig',
            ['projects' => $projects]
        );

    }

}