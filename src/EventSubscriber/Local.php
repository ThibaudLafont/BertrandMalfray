<?php
namespace App\EventSubscriber;

use App\Service\Sluggifier;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class Local implements EventSubscriberInterface
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
            FormEvents::PRE_SUBMIT => 'sluggifyLocalName'
        ];
    }

    public function sluggifyLocalName(FormEvent $event)
    {
        // Get datas
        $local = $event->getData();

        // Generate&Assign slugName
        $name = $local->getName();
        $local->setSlugName($this->getSluggifier()->sluggify($name));

        // Set datas to event
        $event->setData($local);
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
