<?php
namespace App\Form\Type;

use App\Entity\Project\Category;
use App\Entity\Project\HighConcept;
use Doctrine\ORM\Mapping\Entity;
use Hillrange\CKEditor\Form\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

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
                'highConcept',
                HighConceptType::class
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
                'contributorsNbre',
                IntegerType::class
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
                'summary',
                TextareaType::class
            )
            ->add(
                'content',
                CKEditorType::class
            )
            ->add(
                'submit',
                SubmitType::class
            )
        ;
    }
}