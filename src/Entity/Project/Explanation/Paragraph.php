<?php
namespace App\Entity\Project\Explanation;

use App\Traits\Entity\Hydrate;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Paragraph
 *
 * @ORM\Entity
 * @ORM\Table(name="project_explanation_paragraph")
 */
class Paragraph
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
     * Content of paragraph
     *
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

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
     *     inversedBy="paragraphs"
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

    public function normalize()
    {
        return [
            'position' => $this->getPosition(),
            'type' => 'paragraph',
            'attr' => [
                'content' => $this->getContent()
            ]
        ];
    }

}
