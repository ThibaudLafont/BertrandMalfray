<?php
namespace App\Entity\Media\Local;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Model
 *
 * @ORM\Entity()
 * @ORM\Table(name="media_local_category")
 */
class Category extends Local
{

    /**
     * @var \App\Entity\Project\Category
     *
     * @ORM\ManyToOne(
     *     targetEntity="\App\Entity\Project\Category",
     *     inversedBy="localMedias")
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
