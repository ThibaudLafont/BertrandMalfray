<?php
namespace App\Form\Type;

use App\Entity\Project\Category;
use Hillrange\CKEditor\Form\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class
            )
            ->add(
                'category',
                EntityType::class,
                [
                    'class' => Category::class,
                    'choice_label' => 'name'
                ]
            )
            ->add(
                'initDate',
                DateType::class
            )
            ->add(
                'endDate',
                DateType::class
            )
            ->add(
                'highConcept',
                HighConceptType::class
            )
            ->add(
                'skillListItems',
                CollectionType::class,
                [
                    'entry_type' => SkillType::class,  // Use the defined custom type for images
                    'allow_add' => true,               // Allow the form user to add new images
                    'allow_delete' => true,            // Allow the form user to delete existent images
                    'prototype' => true,
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
                CKEditorType::class
            )
            ->add(
                'contributorsNbre',
                IntegerType::class
            )
            ->add(
                'summary',
                TextareaType::class
            )
            ->add(
                'submit',
                SubmitType::class
            )
        ;
    }
}