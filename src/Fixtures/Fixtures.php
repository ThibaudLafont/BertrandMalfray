<?php
namespace App\Fixtures;

use App\Entity\Project\Category;
use App\Entity\Project\Contributor;
use App\Entity\Project\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

/**
 * Parse YAML datas and persist them in DB
 *
 * @package App\Fixtures
 */
class Fixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Load and parse YAML file
        $datas = Yaml::parse(file_get_contents(__DIR__ . '/data/LevelDesign.yaml'));

        // Create&Persist Category
        $category = new Category();
        $category->setName("Level Design");
        $category->setSummary($datas["Level Design"]["summary"]);
        $manager->persist($category);

        // Loop on every Project
        foreach($datas['Projects'] as $k => $v){

            // Create&Hydrate Project
            $project = new Project();
            $project->setName($k);
            $project->hydrate($v);
            // Assign category
            $project->setCategory($category);

            // Check if Project has Contributors
            if(isset($v['contributors'])) {
                // Loop on every Contributor
                foreach($v['contributors'] as $k => $v){
                    $contributor = new Contributor();
                    $contributor->setName($k);
                    $contributor->setRole($v);

                    $project->getContributors()->add($contributor);
                }

            }

            // Persist Project
            $manager->persist($project);
        }

        $manager->flush();
    }

}
