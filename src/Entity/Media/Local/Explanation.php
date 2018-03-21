<?php
namespace App\Entity\Media\Local;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Model
 *
 * @ORM\Entity()
 * @ORM\Table(name="media_local_explanation")
 */
class Explanation extends Local
{

    /**
     * Related Explanation
     *
     * @var \App\Entity\Project\Explanation
     *
     * @ORM\ManyToOne(
     *     targetEntity="\App\Entity\Project\Explanation\Explanation",
     *     inversedBy="locals"
     * )
     */
    private $explanation;

    /**
     * @return \App\Entity\Project\Explanation\Explanation
     */
    public function getExplanation(): \App\Entity\Project\Explanation\Explanation
    {
        return $this->explanation;
    }

    /**
     * @param \App\Entity\Project\Explanation\Explanation $explanation
     */
    public function setExplanation(\App\Entity\Project\Explanation\Explanation $explanation)
    {
        $this->explanation = $explanation;
    }

}
