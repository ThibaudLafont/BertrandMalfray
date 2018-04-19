<?php
namespace App\Form\Type;

use App\Entity\Project\Category;
use App\Entity\Project\HighConcept;
use App\EventSubscriber\Local;
use App\Service\Sluggifier;
use Hillrange\CKEditor\Form\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class LocalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Nom',
                    'attr' => [
                        'placeholder' => 'Nom'
                    ],
                    'constraints' => [
                        new NotNull(['message' => 'Le nom est obligatoire'])
                    ]
                ]
            )
            ->add(
                'alt',
                TextType::class,
                [
                    'label' => 'Description',
                    'attr' => [
                        'placeholder' => 'Description'
                    ],
                    'constraints' => [
                        new NotNull(['message' => 'La description est obligatoire'])
                    ]
                ]
            )
            ->add(  // Set a file field
                'file',
                FileType::class,
                [
                    'label' => 'Fichier',
                    'constraints' => [
                        new NotNull(['message' => 'Le fichier est obligatoire'])
                    ]
                ]
            )
            ->add(  // Set a hidden position field, witch is used in trick display
                'position',
                HiddenType::class,
                [
                    'attr' => ['class' => 'local-position']
                ]
            )
            ->addEventSubscriber(new Local(new Sluggifier()))
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
            'data_class' => 'App\Entity\Media\Local\Project',
        ));
    }

    public function getBlockPrefix()
    {
        return 'LocalType';
    }
}