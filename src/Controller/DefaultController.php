<?php
namespace App\Controller;

use App\Entity\Project\Project;
use App\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

    /**
     * @Route(
     *     "/",
     *     name="homepage"
     * )
     */
    public function listAction(Request $request, \Swift_Mailer $mailer) {

        $form = $this->createForm('App\Form\Type\ContactType');

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $data = $form->getData();

                $message = (new \Swift_Message($data['name'] . ' cherche à te joindre'))
                    ->setSender($data['email'], $data['name'])
                    ->setReplyTo($data['email'], $data['name'])
                    ->setTo(['contact@bertrandmalfray.fr' => 'Bertrand Malfray'])
                    ->setBody("
Nom : {$data['name']} 
Mail: {$data['email']}


Contenu: \"{$data['content']}\"
                    ");

                $mailer->send($message);

                return $this->redirectToRoute('homepage');
            }
        }

        return $this->render(
            'default/homepage.html.twig',
            ['form' => $form->createView()]
        );

    }

}