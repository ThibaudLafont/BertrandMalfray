<?php
namespace App\Entity\Project;

use App\Traits\Entity\Hydrate;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 *
 * @ORM\Entity
 * @ORM\Table(name="project_category")
 */
class Category{


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
     * maxlength, striptags, isString, unique
     * @ORM\Column(name="name", type="string", length=75)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug_name", type="string", length=255)
     */
    protected $slugName;

    /**
     * @var string
     * maxlength, striptags, isString
     * @ORM\Column(name="summary", type="text")
     */
    private $summary;

    /**
     * @var mixed
     *
     * @ORM\OneToMany(
     *     targetEntity="\App\Entity\Project\Lists\CategoryList",
     *     mappedBy="category"
     * )
     */
    private $skillListItems;

    /**
     * Category's projects
     *
     * @var mixed
     *
     * @ORM\OneToMany(
     *     targetEntity="\App\Entity\Project\Project",
     *     mappedBy="category"
     * )
     * @ORM\OrderBy({"initDate" = "DESC"})
     */
    private $projects;

    // Traits
    use Hydrate;

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
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set summary
     *
     * @param string $summary
     */
    public function setSummary(string $summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return mixed
     */
    public function getDistantMedias()
    {
        return $this->distantMedias;
    }

    /**
     * @return mixed
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param mixed $projects
     */
    public function setProjects($projects)
    {
        $this->projects = $projects;
    }

    /**
     * @return string
     */
    public function getSlugName(): string
    {
        return $this->slugName;
    }

    /**
     * @param string $slugName
     */
    public function setSlugName(string $slugName)
    {
        $this->slugName = $slugName;
    }

    /**
     * @return mixed
     */
    public function getSkillListItems()
    {
        return $this->skillListItems;
    }

}
