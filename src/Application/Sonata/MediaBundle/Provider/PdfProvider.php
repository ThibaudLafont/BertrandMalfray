<?php
namespace App\Application\Sonata\MediaBundle\Provider;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\FileProvider;
use Sonata\MediaBundle\Provider\MediaProviderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PdfProvider extends FileProvider
{

    /**
     * {@inheritdoc}
     */
    public function getProviderMetadata()
    {
        return new Metadata($this->getName(), $this->getName().'.description', false, 'SonataMediaBundle', ['class' => 'glyphicon glyphicon-file']);
    }

    /**
     * {@inheritdoc}
     */
    public function generatePublicUrl(MediaInterface $media, $format)
    {
        if (MediaProviderInterface::FORMAT_REFERENCE === $format) {
            $path = '/uploads/media/' . $this->getReferenceImage($media);
        } else {
            $path = '/img/pdf-reference-image.jpg';
        }
        return $path;
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper)
    {
        $formMapper->add('name');
        $formMapper->add('description');
        $formMapper->add('binaryContent', FileType::class, ['required' => false]);
    }

    /**
     * {@inheritdoc}
     * In order to disable thumbnail creation
     */
    public function postPersist(MediaInterface $media)
    {
        if (null === $media->getBinaryContent()) {
            return;
        }

        $this->setFileContents($media);

        $media->resetBinaryContent();
    }

    public function prePersist(MediaInterface $media)
    {
        parent::prePersist($media); // TODO: Change the autogenerated stub
        $media->setContext('default');
    }

}