<?php
namespace App\Service;

use App\Entity\Media\Local\Category;
use App\Entity\Media\Local\Local;
use App\Entity\Media\Local\Project;
use Symfony\Component\HttpFoundation\File\File;

class Uploader
{

    public function uploadToWebServer($local)
    {
        // Check Object
        if(
            $local instanceof Project ||
            $local instanceof Category
        ) {
            // Path generation
            $targetDir = "/var/www/html/public/img/" . $local->getFolderName() . '/';
            // Create folder if inexistent
            // Get File from local object
            $file = $local->getFile();
            // Move file from temp to web server
            $file->move(
                $targetDir,
                $local->getFullFileName()
            );
        }

    }

    public function renameFile(){}
    public function deleteFile(){}

}