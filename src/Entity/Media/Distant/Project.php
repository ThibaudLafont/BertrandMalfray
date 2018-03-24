<?php
namespace App\Entity\Media\Distant;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Project
 *
 * @ORM\Entity()
 * @ORM\Table(name="media_distant_project")
 */
class Project extends Distant
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
