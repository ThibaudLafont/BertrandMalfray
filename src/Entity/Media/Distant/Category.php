<?php
namespace App\Entity\Media\Distant;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Model
 *
 * @ORM\Entity()
 * @ORM\Table(name="media_distant_category")
 */
class Category extends Distant
{

    /**
     * @var \App\Entity\Project\Category
     *
     * @ORM\ManyToOne(
     *     targetEntity="\App\Entity\Project\Category",
     *     inversedBy="distantMedias")
     */
    private $category;

    /**
     * Get Category
     *
     * @return \App\Entity\Project\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set Category
     *
     * @param \App\Entity\Project\Category $category
     */
    public function setCategory(\App\Entity\Project\Category $category)
    {
        $this->category = $category;
    }

}
