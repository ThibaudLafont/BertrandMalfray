<?php
namespace App\Form\Type;

use App\Entity\Project\Category;
use App\Entity\Project\HighConcept;
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

class DistantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class
            )
            ->add(
                'alt',
                TextType::class
            )
            ->add(  // Set a file field
                'src',
                TextType::class
            )
            ->add(  // Set a hidden position field, witch is used in trick display
                'position',
                HiddenType::class,
                [
                    'attr' => ['class' => 'distant-position']
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
            'data_class' => 'App\Entity\Media\Distant\Project',
        ));
    }

    public function getBlockPrefix()
    {
        return 'DistantType';
    }
}