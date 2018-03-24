<?php
namespace App\Entity\Media\Local;

use App\Entity\Enumerations\ImageDisplay;
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
     * @var string
     *
     * @ORM\Column(name="display", type="string")
     */
    private $display;

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

    /**
     * Get display
     *
     * Display value is defined and normed by enumeration class
     *
     * @see ImageDisplay
     *
     * @return string
     */
    public function getDisplay(): string
    {
        return ImageDisplay::getValue($this->display);
    }

    /**
     * Set display
     *
     * Display is normed by Enumeration
     *
     * @see ImageDisplay
     *
     * @param string $display Type of display
     * @return $this          For additional checks
     */
    public function setDisplay(string $display)
    {
        // if invalid key, throw exception
        if (!in_array($display, ImageDisplay::getAvailableTypes())) {
            throw new \InvalidArgumentException("Invalid ProductState");
        }

        // Assign display
        $this->display = $display;

        return $this;
    }

    public function normalize()
    {
        return [
            'position' => $this->getPosition(),
            'type' => 'local',
            'attr' => [
                'src' => $this->getSrc(),
                'alt' => $this->getAlt(),
                'display' => $this->getDisplay()
            ]
        ];
    }

}
