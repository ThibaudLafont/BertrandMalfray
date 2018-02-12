<?php
namespace App\Entity\Project;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Project
 *
 * @ORM\Entity
 * @ORM\Table(name="project")
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
     * @ORM\Column(name="summary", type="text")
     */
    private $summary;

    /**
     * @var string
     * Intent statement of project
     *
     * @ORM\Column(name="intent_state", type="text")
     */
    private $intentState;

    /**
     * @var string
     * Story of project
     *
     * @ORM\Column(name="story", type="text")
     */
    private $story;

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
     * Get intentState
     *
     * @return string
     */
    public function getIntentSate()
    {
        return $this->intentState;
    }

    /**
     * Set intentState
     *
     * @param string $intentState
     */
    public function setIntentSate(string $intentState)
    {
        $this->intentState = $intentState;
    }

    /**
     * Get story
     *
     * @return string
     */
    public function getStory()
    {
        return $this->story;
    }

    /**
     * Set story
     *
     * @param string $story
     */
    public function setStory(string $story)
    {
        $this->story = $story;
    }


}
