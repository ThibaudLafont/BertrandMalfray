<?php
namespace App\Entity\Project\Explanation;

use App\Traits\Entity\Hydrate;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Title
 *
 * @ORM\Entity
 * @ORM\Table(name="project_explanation_title")
 */
class Title
{
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Content of title
     *
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * Level of title (h1, h2 ...)
     *
     * @var int
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * Position of this element for Content display
     *
     * @var int
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * Related Explanation
     *
     * @var \App\Entity\Project\Explanation
     *
     * @ORM\ManyToOne(
     *     targetEntity="Explanation",
     *     inversedBy="titles"
     * )
     */
    private $explanation;

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
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level + 1;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level)
    {
        $this->level = $level;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position)
    {
        $this->position = $position;
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

    /**
     * @return Explanation
     */
    public function getExplanation(): Explanation
    {
        return $this->explanation;
    }

    /**
     * @param Explanation $explanation
     */
    public function setExplanation(Explanation $explanation)
    {
        $this->explanation = $explanation;
    }

}
