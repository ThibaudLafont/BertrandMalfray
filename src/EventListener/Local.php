<?php
namespace App\EventListener;

use App\Entity\Media\Local\Explanation;
use App\Entity\Media\Local\Project;
use App\Service\Sluggifier;
use App\Service\Uploader;

/**
 * Class MessageListener
 *
 * Execute actions when Doctrine work with Messages entities
 *
 * @package AppBundle\EventListener
 */
class Local
{
    /**
     * @var Uploader
     */
    private $uploader;

    public function __construct(Uploader $uploader, Sluggifier $sluggifier)
    {
        $this->setUploader($uploader);
    }

    /**
     * Upload Local file to webserver
     *
     * @param Local $local
     */
    public function prePersist($local)
    {
        // Ask upload if Object is right type
        if(
            $local instanceof Project
        ){
            // Set Extension
            $local->setExtension($local->getFile()->getExtension());

            // Folder Name
            $local->setFolderName(
                $local->getProject()
                    ->getCategory()->getSlugName()
            );

            // Upload
            $this->getUploader()->uploadToWebServer($local);
        }

    }

    /**
     * @return Uploader
     */
    public function getUploader(): Uploader
    {
        return $this->uploader;
    }

    /**
     * @param Uploader $uploader
     */
    public function setUploader(Uploader $uploader)
    {
        $this->uploader = $uploader;
    }
}
