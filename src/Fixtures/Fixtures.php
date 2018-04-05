<?php
namespace App\Fixtures;

use App\Entity\Media\Local\Explanation;
use App\Entity\Project\Category;
use App\Entity\Project\Contributor;
use App\Entity\Project\Explanation\Paragraph;
use App\Entity\Project\Explanation\Title;
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

            // Create Explanation
            $explanation = new \App\Entity\Project\Explanation\Explanation();
            $manager->persist($explanation);

            // Assign explanation to project
            $project->setExplanation($explanation);

            // Treatment of Explanation parts
            $parts = $v['content'];
            // Loop on every part
            foreach($parts as $position => $attributes)
            {
                // If part is title
                if ($attributes['type'] === 'title') {

                    // Create Title and assign Explanation
                    $entity = $this->createTitle(
                        $attributes['level'],
                        $attributes['content'],
                        $position
                    );

                // If part is paragraph
                } elseif ($attributes['type'] === 'paragraph') {

                    // Create and hydrate Paragraph
                    $entity = $this->createParagraph($attributes['content'], $position);

                } elseif ($attributes['type'] === 'local') {

                    // create local entity
                    $entity = $this->createExplanationLocal($position, $attributes);

                }

                // Set explanation & persist entity
                $entity->setExplanation($explanation);
                $manager->persist($entity);

            }

            // Check if project has medias
            if(isset($v['medias'])) {
                // Check if project has local medias
                if(isset($v['medias']['local'])) {
                    foreach($v['medias']['local'] as $position => $datas) {

                        // Create Local and set Project
                        $local = $this->createProjectLocal($position, $datas);
                        $local->setProject($project);

                        // Persist
                        $manager->persist($local);

                    }
                }
                // Check if project has distant medias
                if (isset($v['medias']['distant'])) {
                    // Loop on every Distant medias
                    foreach($v['medias']['distant'] as $position => $datas) {

                        // Create Distant and set Project
                        $distant = $this->createProjectDistant($position, $datas);
                        $distant->setProject($project);

                        // Persist
                        $manager->persist($distant);

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

    private function createParagraph(string $content, int $position)
    {
        // Create and hydrate paragraph
        $paragraph = new Paragraph();
        $paragraph->setPosition($position);
        $paragraph->setContent($content);

        // Return object
        return $paragraph;
    }

    private function createTitle(int $level, string $content, int $position)
    {
        // Create and hydrate Title
        $title = new Title();
        $title->setLevel($level);
        $title->setContent($content);
        $title->setPosition($position);

        // Return object
        return $title;
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
        $category->setSlugName(
            $this->getSluggifier()->sluggify($datas['name'])
        );
        $category->setSummary($datas['summary']);

        // Return object
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
        $project->setSlugName(
            $this->getSluggifier()->sluggify($name)
        );
        $project->hydrate($datas);

        // Return object
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

        // Return object
        return $contributor;

    }

    private function createProjectDistant(int $position, array $datas)
    {
        // Create and hydrate Distant
        $distant = new \App\Entity\Media\Distant\Project();
        $distant->setName($datas['name']);
        $distant->setAlt($datas['alt']);
        $distant->setSrc($datas['src']);
        $distant->setPosition($position);

        // Return object
        return $distant;
    }

    private function createProjectLocal(int $position, array $datas)
    {
        // Create Project Local
        $local = new \App\Entity\Media\Local\Project();

        // Return hydrated Local
        return $this->createLocal($local, $position, $datas);

    }

    private function createExplanationLocal(int $position, array $datas)
    {
        // Create Project Local
        $local = new \App\Entity\Media\Local\Explanation();

        // Set display attr
        $local->setDisplay($datas['display']);

        // Return hydrated Local
        return $this->createLocal($local, $position, $datas);

    }

    private function createLocal($local, int $position, array $datas)
    {
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
