<?php
namespace App\EventSubscriber;

use App\Service\Sluggifier;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class Project implements EventSubscriberInterface
{

    /**
     * @var Sluggifier
     */
    private $sluggifier;

    public function __construct(Sluggifier $sluggifier)
    {
        $this->setSluggifier($sluggifier);
    }

    public static function getSubscribedEvents()
    {
        return [
            FormEvents::SUBMIT => 'sluggifyProjectName'
        ];
    }

    public function sluggifyProjectName(FormEvent $event)
    {
        // Get datas
        $project = $event->getData();

        if($project instanceof \App\Entity\Project\Project) {
            // Generate&Assign slugName
            $name = $project->getName();
            $project->setSlugName($this->getSluggifier()->sluggify($name));

            // Set datas to event
            $event->setData($project);
        }
    }

    /**
     * Get Sluggifier
     *
     * @return Sluggifier
     */
    public function getSluggifier(): Sluggifier
    {
        return $this->sluggifier;
    }

    /**
     * Set Sluggifier
     *
     * @param Sluggifier $sluggifier
     */
    public function setSluggifier(Sluggifier $sluggifier)
    {
        $this->sluggifier = $sluggifier;
    }
}
