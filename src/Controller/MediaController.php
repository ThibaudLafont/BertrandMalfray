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
     * @Route("/ck_upload", name="ck_img_upload")
     * @return JsonResponse
     */
    public function uploadAction(Request $request)
    {
        // Get file
        $file = $request->files->get('upload');

        // Init resp
        $resp = [];

        // Move file
        if($file instanceof UploadedFile) {
            // Check if image
            if(in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png'])) {
                // Move file
                $file = $file->move('/var/www/html/public/img/ckeditor', $file->getClientOriginalName());

                // Build resp
                $resp = [
                    'uploaded' => 1,
                    'fileName' => $file->getFilename(),
                    'url' => '/img/ckeditor/' . $file->getFilename()
                ];
            } else {
                // Build resp
                $resp = [
                    'uploaded' => 0,
                    'error' => ["message" => "Les seules extensions autorisées sont jpg, jpeg et png"]
                ];
            }
        }

        // Prepare Response
        return new JsonResponse($resp);
    }

}