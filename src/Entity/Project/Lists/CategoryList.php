<?php
namespace App\Entity\Project\Lists;

use App\Entity\Project\Category;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Project\Project;

/**
 * Class CategoryList
 * @package App\Entity\Project\Lists
 *
 * @ORM\Entity()
 * @ORM\Table(name="category_skills_list")
 */
class CategoryList extends AbstractList
{

    /**
     * @var Category
     *
     * @ORM\ManyToOne(
     *     targetEntity="\App\Entity\Project\Category",
     *     inversedBy="skillListItems"
     * )
     */
    private $category;

    /**
     * @return Category
     */
    public function getCategory(): Category
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

}
