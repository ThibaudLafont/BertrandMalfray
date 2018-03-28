<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => false,
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Nom complet'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Le nom est obligatoire'
                        ]),
                    ]
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => false,
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Addresse mail'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'L\'email est obligatoire'
                        ]),
                        new Email([
                            'message' => 'Veuillez fournir un mail valide',
                            'checkMX' => true,
                            'checkHost' => true
                        ])
                    ]
                ]
            )
            ->add(
                'content',
                TextareaType::class,
                [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Contenu de votre message'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Un contenu est obligatoire'
                        ])
                    ]
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'Envoyer'
                ]
            )
        ;
    }
}