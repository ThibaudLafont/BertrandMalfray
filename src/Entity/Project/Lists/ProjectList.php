<?php
namespace App\Entity\Project\Lists;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Project\Project;

/**
 * Class ProjectList
 * @package App\Entity\Project\Lists
 *
 * @ORM\Entity()
 * @ORM\Table(name="project_skills_list")
 */
class ProjectList extends AbstractList
{

    /**
     * @var Project
     *
     * @ORM\ManyToOne(
     *     targetEntity="\App\Entity\Project\Project",
     *     inversedBy="skillListItems"
     * )
     */
    private $project;

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     */
    public function setProject(Project $project)
    {
        $this->project = $project;
    }

}
