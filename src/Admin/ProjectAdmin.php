<?php
namespace App\Admin;

use App\Entity\Project\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Sonata\FormatterBundle\Form\Type\FormatterType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProjectAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Projet', ['class' => 'col-md-8'])
                ->add('name', TextType::class, [
                    'label' => 'Nom du projet'
                ])
                ->add('category', EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'label' => 'Catégorie'
                ])
                ->add('summary', TextareaType::class, [
                    'label' => 'Résumé'
                ])
                ->add('content', FormatterType::class, [
                    'format_field_options' => [
                        'choices' => [
                            'richhtml' => 'richhtml'
                        ],
                        'data' => 'richhtml',
                    ],
                    'source_field'         => 'rawContent',
                    'source_field_options' => [
                        'attr' => [
                            'class' => 'span10',
                            'rows' => 30
                        ],
                    ],
                    'format_field'         => 'contentFormatter',
                    'target_field'         => 'content',
                    'ckeditor_context'     => 'default',
                    'event_dispatcher'     => $formMapper->getFormBuilder()->getEventDispatcher(),
                ])
            ->end()
            ->with('Détails', ['class' => 'col-md-4'])
                ->add('initDate', DateType::class, [
                    'format' => 'ddMMyyyy',
                    'label' => 'Initié le',
                    'years' => range(2016, date('Y'))
                ])
                ->add('endDate', DateType::class, [
                    'format' => 'ddMMyyyy',
                    'label' => 'Terminé le',
                    'years' => range(2016, date('Y'))
                ])
                ->add('contributorsNbre', NumberType::class, [
                    'label' => 'Nombre de contributeurs'
                ])
            ->end()
            ->with('High Concept', ['class' => 'col-md-4'])
                ->add('highConceptType', TextType::class, [
                    'label' => 'Type'
                ])
                ->add('highConceptGender', TextType::class, [
                    'label' => 'Genre'
                ])
                ->add('highConceptTarget', TextType::class, [
                    'label' => 'Cible'
                ])
            ->end()
            ->with('Gallerie', ['class' => 'col-md-8'])
                ->add('projectHasMedias', CollectionType::class, [
                    'by_reference' => false,
                    'label' => 'Gallerie'
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                    'admin_code' => 'custom.media.admin.project_has_media'
                ])
            ->end()
            ->with('Liste de compétences', ['class' => 'col-md-4'])
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')
            ->add('category.name');
    }
}