<?php
namespace App\Entity\Media\Local;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Model
 *
 * @ORM\Entity()
 * @ORM\Table(name="media_local_project")
 *
 * @UniqueEntity(
 *     fields="name",
 *     message="L'image {{ value }} porte le même nom qu'une image déjà en ligne"
 * )
 * @UniqueEntity(
 *     fields="slugName",
 *     message="L'image {{ value }} génère le même slug-name qu'une autre image, modifiez son nom"
 * )
 */
class Project extends Local
{

    /**
     * @var \App\Entity\Project\Project
     *
     * @ORM\ManyToOne(
     *     targetEntity="\App\Entity\Project\Project",
     *     inversedBy="localMedias"
     * )
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
