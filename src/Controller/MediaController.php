<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MediaController extends Controller
{

    /**
     * @param Request $request
     *
     * @Route("/upload", name="upload_ck")
     * @return JsonResponse
     */
    public function uploadAction(Request $request)
    {
        // Get file
        $file = $request->files->get('upload');


        // Move file
        if($file instanceof UploadedFile) {
            $file = $file->move('/var/www/html/public/img/ckeditor', $file->getClientOriginalName());
        }

        // Prepare Response
        $resp = [
            'uploaded' => 1,
            'fileName' => $file->getFilename(),
            'url' => '/img/ckeditor/' . $file->getFilename()
        ];

        return new JsonResponse($resp);
    }

}