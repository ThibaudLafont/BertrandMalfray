<?php
namespace App\Entity\Project;

use App\Entity\Project\Explanation\Explanation;
use App\Entity\Project\Lists\ProjectList;
use App\Traits\Entity\Hydrate;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Config\Definition\Exception\InvalidTypeException;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\IsTrue;

/**
 * Class Project
 *
 * @ORM\Entity("App\Repository\Project\ProjectRepository")
 * @ORM\Table(name="project_project")
 * @ORM\EntityListeners({"App\EventListener\Project"})
 *
 * @UniqueEntity(
 *     "name",
 *     message="Un projet portant le même nom est déjà en ligne"
 * )
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
     * @var string
     *
     * @ORM\Column(name="slug_name", type="string", length=255)
     */
    protected $slugName;

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
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="contributors_nbre", type="integer")
     */
    private $contributorsNbre;

    /**
     * @var mixed
     *
     * @ORM\OneToMany(
     *     targetEntity="\App\Entity\Project\Lists\ProjectList",
     *     mappedBy="project",
     *     cascade={"persist", "remove", "refresh"}
     * )
     */
    private $skillListItems;

    /**
     * @var HighConcept
     *
     * @ORM\OneToOne(
     *     targetEntity="HighConcept",
     *     cascade={"persist"}
     * )
     */
    private $highConcept;

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
     *     targetEntity="\App\Entity\Media\Local\Project",
     *     mappedBy="project",
     *     cascade={"persist"}
     * )
     */
    private $localMedias;

    /**
     * @var mixed
     *
     * @ORM\OneToMany(
     *     targetEntity="\App\Entity\Media\Distant\Project",
     *     mappedBy="project",
     *     cascade={"persist"}
     * )
     */
    private $distantMedias;

    // Traits
    use Hydrate;

    public function __construct()
    {
        $this->skillListItems = new ArrayCollection();
        $this->localMedias = new ArrayCollection();
        $this->distantMedias = new ArrayCollection();
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
     * @return Category
     */
    public function getCategory()
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

    public function getDuration()
    {
        return $this->getInitDate()
            ->diff(
                $this->getEndDate(),
                true
            )
            ->format('%a jours')
        ;
    }

    public function getShowUrl()
    {
        return '/project/' . $this->getSlugName();
    }

    /**
     * @return mixed
     */
    public function getLocalMedias()
    {
        return $this->localMedias;
    }

    public function setLocalMedias(array $medias) {
        foreach ($medias as $media) {
            if($media instanceof \App\Entity\Media\Local\Project) {
                $this->localMedias->add($media);

                $media->setProject($this);
            }
        }
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
    public function getDistantMedias()
    {
        return $this->distantMedias;
    }

    public function setDistantMedias(array $medias) {
        foreach ($medias as $media) {
            if($media instanceof \App\Entity\Media\Distant\Project) {
                $this->distantMedias->add($media);

                $media->setProject($this);
            }
        }
    }

    /**
     * @return string
     */
    public function getContributorsNbre()
    {
        return $this->contributorsNbre;
    }

    /**
     * @return string
     */
    public function getContributorsNbreDisplay() : string
    {
        $count = $this->contributorsNbre;
        if($count === 0) return 'Aucun collaborateur';
        return $count . ' collaborateurs';
    }

    /**
     * @param int $contributorsNbre
     */
    public function setContributorsNbre(int $contributorsNbre)
    {
        $this->contributorsNbre = $contributorsNbre;
    }

    /**
     * @return mixed
     */
    public function getSkillListItems()
    {
        return $this->skillListItems;
    }

    public function setSkillListItems(array $skills) {

        foreach ($skills as $skill) {
            if($skill instanceof ProjectList) {
                $this->skillListItems->add($skill);

                $skill->setProject($this);
            }
        }

    }

    public function addSkillListItem(ProjectList $skill) {
        $skill->setProject($this);
        $this->skillListItems->add($skill);
    }

    public function removeSkillListItem(ProjectList $skill) {
        $this->skillListItems->removeElement($skill);
    }

    /**
     * @return HighConcept
     */
    public function getHighConcept(): HighConcept
    {
        return $this->highConcept;
    }

    /**
     * @param HighConcept $highConcept
     */
    public function setHighConcept(HighConcept $highConcept)
    {
        $this->highConcept = $highConcept;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

}
