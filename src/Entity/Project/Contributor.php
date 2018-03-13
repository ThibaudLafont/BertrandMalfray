<?php
namespace App\Entity\Project;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Contributor
 *
 * @ORM\Entity
 * @ORM\Table(name="project_contributor")
 */
class Contributor{


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=75)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string")
     */
    private $role;

    /**
     * @var Project
     *
     * @ORM\OneToMany(
     *     targetEntity="\App\Entity\Project\Project",
     *     mappedBy="contributors"
     * )
     */
    private $project;

    /**
     * Get id
     *
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set role
     *
     * @param string $role
     */
    public function setRole(string $role)
    {
        $this->role = $role;
    }

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
