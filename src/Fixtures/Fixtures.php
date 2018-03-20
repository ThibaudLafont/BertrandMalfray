<?php
namespace App\Fixtures;

use App\Entity\Project\Category;
use App\Entity\Project\Contributor;
use App\Entity\Project\Project;
use App\Service\Sluggifier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;
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
     * @var Sluggifier
     */
    private $sluggifier;

    public function __construct(Sluggifier $sluggifier)
    {
        $this->setSluggifier($sluggifier);
    }

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
        $this->loadCategoryProjects($datas);

        // Load and parse GD YAML file
        $datas =  Yaml::parse(file_get_contents(__DIR__ . '/data/GameDesign.yaml'));
        $this->loadCategoryProjects($datas);

        // Flush results
        $manager->flush();
    }

    /**
     * From YAML::parse, init and persist objects
     * General method for persist Category, Projects, Medias, Contributors
     *
     * @param array $datas
     */
    private function loadCategoryProjects(array $datas)
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

            // Check if project has medias
            if(isset($v['medias'])) {
                // Check if project has local medias
                if(isset($v['medias']['local'])) {
                    foreach($v['medias']['local'] as $k => $v) {

                        // Create Local and set Project
                        $local = $this->createLocal($k, $v);
                        $local->setProject($project);

                        $manager->persist($local);

                    }
                }
            }

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

    /**
     * Create and Hydrate Category from array
     *
     * @param array $datas
     * @return Category
     */
    private function createCategory(array $datas)
    {

        // Create&Persist Category
        $category = new Category();
        $category->setName($datas['name']);
        $category->setSummary($datas['summary']);

        return $category;

    }

    /**
     * Create and Hydrate Project
     *
     * @param string $name
     * @param array $datas
     * @return Project
     */
    private function createProject(string $name, array $datas)
    {

        // Create&Hydrate Project
        $project = new Project();
        $project->setName($name);
        $project->hydrate($datas);

        return $project;

    }

    /**
     * Create and Hydrate Contributor
     *
     * @param string $name
     * @param string $role
     * @return Contributor
     */
    private function createContributor(string $name, string $role)
    {

        // Create&hydrate Contributor
        $contributor = new Contributor();
        $contributor->setName($name);
        $contributor->setRole($role);

        return $contributor;

    }

    private function createLocal(int $position, array $datas)
    {
        // Create Project Local
        $local = new \App\Entity\Media\Local\Project();
        // Inquire attributes
        $local->hydrate($datas);         // Hydrate with datas array
        $local->setPosition($position);  // Set position
        $local->setSlugName(             // Generate slug-name
            $this->getSluggifier()->sluggify($datas['name'])
        );

        // Store relative path to media
        $fileName = $datas['name']
            . '.'
            . $datas['extension']
        ;

        // Copy media to temp dir
        copy(
            __DIR__ . '/data/medias/' . $datas['folder_name'] . '/' . $fileName,
            __DIR__ . '/data/medias/temp/' . $fileName
        );

        // Create File Object
        $file = new File(
            '/var/www/html/src/Fixtures/data/medias/temp/'
            . $datas['name']
            . '.'
            . $datas['extension']
        );

        // Assign created File to Local
        $local->setFile($file);

        return $local;
    }

    /**
     * Get manager
     *
     * @return ObjectManager
     */
    public function getManager(): ObjectManager
    {
        return $this->manager;
    }

    /**
     * Set manager
     *
     * @param ObjectManager $manager
     */
    public function setManager(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return Sluggifier
     */
    public function getSluggifier(): Sluggifier
    {
        return $this->sluggifier;
    }

    /**
     * @param Sluggifier $sluggifier
     */
    public function setSluggifier(Sluggifier $sluggifier)
    {
        $this->sluggifier = $sluggifier;
    }

}
