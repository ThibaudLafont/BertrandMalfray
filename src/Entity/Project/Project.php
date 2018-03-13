<?php
namespace App\Entity\Project;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Config\Definition\Exception\InvalidTypeException;

/**
 * Class Project
 *
 * @ORM\Entity
 * @ORM\Table(name="project_project")
 */
class Project{


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
     * Date of project initialisation
     *
     * @var \DateTime
     *
     * @ORM\Column(name="init_date", type="datetime")
     */
    private $initDate;

    /**
     * Date of project ending
     *
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime")
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text")
     */
    private $summary;

    /**
     * @var string
     * Intent statement of project
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * Category of project
     *
     * @var Category
     *
     * @ORM\ManyToOne(
     *     targetEntity="\App\Entity\Project\Category",
     *     inversedBy="projects"
     * )
     */
    private $category;

    /**
     * @var mixed
     *
     * @ORM\OneToMany(
     *     targetEntity="\App\Entity\Project\Contributor",
     *     mappedBy="projects",
     *     cascade={"persist"}
     * )
     */
    private $contributors;

    public function __construct()
    {
        $this->contributors = new ArrayCollection();
    }

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
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return \DateTime
     */
    public function getInitDate(): \DateTime
    {
        return $this->initDate;
    }

    private function stringToDateTime(string $date)
    {
        return new \DateTime($date);
    }

    /**
     * @param \DateTime|string $initDate
     */
    public function setInitDate($initDate)
    {
        if(is_string($initDate)) $initDate = $this->stringToDateTime($initDate);
        elseif(!($initDate instanceof \DateTime)) throw new InvalidTypeException("InitDate is not string or datetime");

        $this->initDate = $initDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime|string $endDate
     */
    public function setEndDate($endDate)
    {
        if(is_string($endDate)) $endDate = $this->stringToDateTime($endDate);
        elseif(!($endDate instanceof \DateTime)) throw new InvalidTypeException("EndDate is not string or datetime");

        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getContributors()
    {
        return $this->contributors;
    }

    /**
     * @param mixed $contributors
     */
    public function setContributors($contributors)
    {
        $this->contributors = $contributors;
    }

}
