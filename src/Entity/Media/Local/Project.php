<?php
namespace App\Entity\Media\Local;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Model
 *
 * @ORM\Entity()
 * @ORM\Table(name="media_local_project")
 */
class Project extends Local
{

    /**
     * @var \App\Entity\Project\Project
     *
     * @ORM\ManyToOne(
     *     targetEntity="\App\Entity\Project\Project",
     *     inversedBy="distantMedias")
     */
    private $project;

    /**
     * Get Project
     *
     * @return \App\Entity\Project\Project
     */
    public function getProject() : \App\Entity\Project\Project
    {
        return $this->project;
    }

    /**
     * Set Project
     *
     * @param \App\Entity\Project\Project $project
     */
    public function setProject(\App\Entity\Project\Project $project)
    {
        $this->project = $project;
    }

}
