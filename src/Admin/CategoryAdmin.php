<?php
namespace App\Admin;

use App\Entity\Project\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Catégorie', ['class' => 'col-md-8'])
                ->add('name', TextType::class)
                ->add('summary', TextareaType::class)
            ->end()
            ->with('Liste de compétences', ['class' => 'col-md-4'])
                ->add('skillListItems', CollectionType::class, [
                    'by_reference' => false,
                    'label' => 'Compétences'
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                    'admin_code' => 'admin.category.skill'
                ])
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }

    public function toString($object)
    {
        return $object instanceof Category
            ? $object->getName()
            : 'Catégorie'; // shown in the breadcrumb on the create view
    }
}