<?php
namespace App\Form\Type;

use App\Entity\Project\Category;
use App\Entity\Project\HighConcept;
use Hillrange\CKEditor\Form\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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

class HighConceptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'type',
                TextType::class,
                [
                    'label' => 'Type',
                    'attr' => [
                        'placeholder' => 'ex: VR'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Le type est obligatoire'
                        ])
                    ]
                ]
            )
            ->add(
                'gender',
                TextType::class,
                [
                    'label' => 'Genre',
                    'attr' => [
                        'placeholder' => 'ex: FPS'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Le genre est obligatoire'
                        ])
                    ]
                ]
            )
            ->add(
                'target',
                TextType::class,
                [
                    'label' => 'Cible',
                    'attr' => [
                        'placeholder' => 'ex: Adulte'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'La cible est obligatoire'
                        ])
                    ]
                ]
            )
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
            'data_class' => 'App\Entity\Project\HighConcept',
            'error_bubbling' => true
        ));
    }

    public function getBlockPrefix()
    {
        return 'HighConceptType';
    }
}