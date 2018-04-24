<?php
namespace App\Form\Type;

use App\Entity\Project\Category;
use App\Entity\Project\Project;
use App\Service\Sluggifier;
use Hillrange\CKEditor\Form\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Range;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'attr' => [
                        'placeholder' => 'Titre du projet'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Le nom est obligatoire'
                        ])
                    ]
                ]
            )
            ->add(
                'category',
                EntityType::class,
                [
                    'label' => 'Catégorie',
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'constraints' => [
                        new NotNull(['message' => 'La catégorie est obligatoire'])
                    ]
                ]
            )
            ->add(
                'initDate',
                DateType::class,
                [
                    'label' => 'Débuté le'
                ]
            )
            ->add(
                'endDate',
                DateType::class,
                [
                    'label' => 'Terminé le'
                ]
            )
            ->add(
                'highConcept',
                HighConceptType::class
            )
            ->add(
                'skillListItems',
                CollectionType::class,
                [
                    'label' => 'Compétences mobilisées',
                    'entry_type' => SkillType::class,  // Use the defined custom type for images
                    'allow_add' => true,               // Allow the form user to add new images
                    'allow_delete' => true,            // Allow the form user to delete existent images
                    'prototype' => true,
                    'by_reference' => false,
                    'attr' => [
                        'class' => 'skill-collection',
                        'id' => 'skills'
                    ],
                    'entry_options' => [
                        'label' => false
                    ]
                ]
            )
            ->add(
                'localMedias',
                CollectionType::class,
                [
                    'entry_type' => LocalType::class,  // Use the defined custom type for images
                    'allow_add' => true,               // Allow the form user to add new images
                    'allow_delete' => true,            // Allow the form user to delete existent images
                    'prototype' => true,
                    'attr' => [
                        'class' => 'local-collection',
                        'id' => 'local'
                    ],
                    'entry_options' => [
                        'label' => false
                    ],
                    'constraints' => [
                        new Count([
                            'min' => 1,
                            'minMessage' => 'Une image locale est nécessaire'
                        ])
                    ]
                ]
            )
            ->add(
                'distantMedias',
                CollectionType::class,
                [
                    'entry_type' => DistantType::class,  // Use the defined custom type for images
                    'allow_add' => true,               // Allow the form user to add new images
                    'allow_delete' => true,            // Allow the form user to delete existent images
                    'prototype' => true,
                    'attr' => [
                        'class' => 'distant-collection',
                        'id' => 'distant'
                    ],
                    'entry_options' => [
                        'label' => false
                    ]
                ]
            )
            ->add(
                'content',
                CKEditorType::class,
                [
                    'config' => [
                        'height' => '500px'
                    ],
                    'constraints' => [
                        new NotBlank(['message' => 'Le contenu est obligatoire'])
                    ]
                ]
            )
            ->add(
                'contributorsNbre',
                IntegerType::class,
                [
                    'label' => 'Contributeurs',
                    'attr' => [
                        'placeholder' => '0'
                    ],
                    'constraints' => [
                        new Range([
                            'min' => 0,
                            'minMessage' => 'Le nombre doit être positif --\'. Je rigole d\'avance si tu l\'as activée ahahahahah'
                        ])
                    ]
                ]
            )
            ->add(
                'summary',
                TextareaType::class,
                [
                    'label' => 'Résumé',
                    'attr' => [
                        'placeholder' => 'Résumé de 200 caractères environ',
                        'rows' => 4
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Le nom est obligatoire'
                        ]),
                        new Length([
                            'min' => 100,
                            'minMessage' => "! Au moins {{ limit }} caractères"
                        ])
                    ]
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'Publier'
                ]
            )
            ->addEventSubscriber(new \App\EventSubscriber\Project(new Sluggifier()))
        ;
    }
    /**
     * Configure options to this form type
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            // Define the target entity
            'data_class' => 'App\Entity\Project\Project',
        ));
    }

    public function getBlockPrefix()
    {
        return 'ProjectType';
    }
}