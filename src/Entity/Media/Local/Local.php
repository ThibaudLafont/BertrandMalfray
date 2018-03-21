<?php
namespace App\Entity\Media\Local;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Media\Media;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Local
 *
 * @ORM\MappedSuperclass()
 * @ORM\EntityListeners({"App\EventListener\Local"})
 */
abstract class Local extends Media
{
    /**
     * @var string
     *
     * @ORM\Column(name="slug_name", type="string", length=255)
     */
    protected $slugName;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=6)
     */
    protected $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="folder_name", type="string", length=255)
     */
    protected $folderName;

    /**
     * Display order
     *
     * @var int
     *
     * @ORM\Column(name="position", type="integer", length=255)
     */
    protected $position;

    /**
     * @var File|UploadedFile
     */
    protected $file;

    public function getFullFileName()
    {
        return $this->getSlugName() . '.' . $this->getExtension();
    }

    /**
     * Set slugName.
     *
     * @param string $slugName
     *
     * @return Local
     */
    public function setSlugName($slugName)
    {
        $this->slugName = $slugName;

        return $this;
    }

    /**
     * Get slugName.
     *
     * @return string
     */
    public function getSlugName()
    {
        return $this->slugName;
    }

    /**
     * Set extension.
     *
     * @param string $extension
     *
     * @return Local
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension.
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set folderName.
     *
     * @param string $folderName
     *
     * @return Local
     */
    public function setFolderName($folderName)
    {
        $this->folderName = $folderName;

        return $this;
    }

    /**
     * Get folderName.
     *
     * @return string
     */
    public function getFolderName()
    {
        return $this->folderName;
    }

    /**
     * Get file
     *
     * @return File|UploadedFile
     */
    public function getFile() : File
    {
        return $this->file;
    }

    /**
     * Set file
     *
     * @param File|UploadedFile $file
     */
    public function setFile(File $file)
    {
        $this->file = $file;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position)
    {
        $this->position = $position;
    }
}
