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

        $titles = $this->getTitles();
        $paras = $this->getParagraphs();
        $locals = $this->getLocals();

        $return = [];

        foreach($titles as $title) {
            $return[$title->getPosition()] = [
                'position' => $title->getPosition(),
                'type'    => 'title',
                'attr'    => [
                    'level'   => $title->getLevel(),
                    'content' => $title->getContent()
                ],
            ];
        }

        foreach($paras as $para)
        {
            $return[$para->getPosition()] = [
                'position' => $para->getPosition(),
                'type' => 'paragraph',
                'attr' => [
                    'content' => $para->getContent()
                ]
            ];
        }

        foreach($locals as $local)
        {
            $return[$local->getPosition()] = [
                'position' => $local->getPosition(),
                'type' => 'local',
                'attr' => [
                    'src' => $local->getSrc(),
                    'alt' => $local->getAlt()
                ]
            ];
        }
        asort($return);
        return $return;

    }

}
