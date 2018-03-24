<?php
namespace App\Entity\Media\Distant;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Media\Media;

/**
 * Distant
 *
 * @ORM\MappedSuperclass()
 */
abstract class Distant extends Media
{

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="string", length=255)
     */
    protected $src;

    /**
     * Set src.
     *
     * @param string $src
     *
     * @return Distant
     */
    public function setSrc($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get src.
     *
     * @return string
     */
    public function getSrc()
    {
        return str_replace('watch?v=', 'embed/', $this->src);
    }
}
