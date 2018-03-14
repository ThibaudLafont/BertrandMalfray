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
     * @var ObjectManager
     */
    private $manager;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Store manager
        $this->setManager($manager);

        // Load and parse LD YAML file
        $datas = Yaml::parse(file_get_contents(__DIR__ . '/data/LevelDesign.yaml'));
        $this->loadProjects($datas);

        // Load and parse GD YAML file
        $datas =  Yaml::parse(file_get_contents(__DIR__ . '/data/GameDesign.yaml'));
        $this->loadProjects($datas);

        $manager->flush();
    }

    private function loadProjects(array $datas)
    {
        // Get manager
        $manager = $this->getManager();

        // Create&Persist Category
        $category = $this->createCategory($datas['category']);
        $manager->persist($category);

        // Loop on every Project
        foreach($datas['projects'] as $k => $v){

            // Create Project
            $project = $this->createProject($k, $v);
            // Assign category
            $project->setCategory($category);
            // Persist Project
            $manager->persist($project);

            // Check if Project has Contributors
            if(isset($v['ext_contributors'])) {

                // Loop on every Contributor
                foreach($v['ext_contributors'] as $k => $v){

                    // Create and hydrate
                    $contributor = $this->createContributor($k, $v);
                    // Assign Project
                    $contributor->setProject($project);
                    // Persist contributor
                    $manager->persist($contributor);

                }

            }
        }
    }

    private function createCategory(array $datas)
    {

        // Create&Persist Category
        $category = new Category();
        $category->setName($datas['name']);
        $category->setSummary($datas['summary']);

        return $category;

    }

    private function createProject(string $name, array $datas)
    {

        // Create&Hydrate Project
        $project = new Project();
        $project->setName($name);
        $project->hydrate($datas);

        return $project;

    }

    private function createContributor(string $name, string $role)
    {

        // Create&hydrate Contributor
        $contributor = new Contributor();
        $contributor->setName($name);
        $contributor->setRole($role);

        return $contributor;

    }

    /**
     * @return ObjectManager
     */
    public function getManager(): ObjectManager
    {
        return $this->manager;
    }

    /**
     * @param ObjectManager $manager
     */
    public function setManager(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

}
