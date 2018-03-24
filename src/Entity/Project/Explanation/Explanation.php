<?php
namespace App\Entity\Project\Explanation;

use App\Traits\Entity\Hydrate;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Content
 *
 * @ORM\Entity
 * @ORM\Table(name="project_explanation")
 */
class Explanation
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
     * Titles of Explanation
     *
     * @var mixed
     *
     * @ORM\OneToMany(
     *     targetEntity="Title",
     *     mappedBy="explanation"
     * )
     */
    private $titles;

    /**
     * Paragraphs of Explanation
     *
     * @var mixed
     *
     * @ORM\OneToMany(
     *     targetEntity="Paragraph",
     *     mappedBy="explanation"
     * )
     */
    private $paragraphs;

    /**
     * Local medias of Explanation
     *
     * @var mixed
     *
     * @ORM\OneToMany(
     *     targetEntity="\App\Entity\Media\Local\Explanation",
     *     mappedBy="explanation"
     * )
     */
    private $locals;

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
     * Get locals
     *
     * @return mixed
     */
    public function getLocals()
    {
        return $this->locals;
    }

    /**
     * @return mixed
     */
    public function getTitles()
    {
        return $this->titles;
    }

    /**
     * @return mixed
     */
    public function getParagraphs()
    {
        return $this->paragraphs;
    }

    public function getContent()
    {
        // init empty array
        $return = [];

        // Normalize & Store each title
        $titles = $this->getTitles();
        foreach($titles as $title)
        {
            $return[$title->getPosition()] = $title->normalize();
        }

        // Normalize & Store each paragraph
        $paras = $this->getParagraphs();
        foreach($paras as $para)
        {
            $return[$para->getPosition()] = $para->normalize();
        }

        // Normalize & Store each local
        $locals = $this->getLocals();
        foreach($locals as $local)
        {
            $return[$local->getPosition()] = $local->normalize();
        }

        // Sort array by index
        asort($return);

        // Return result
        return $return;
    }

}
