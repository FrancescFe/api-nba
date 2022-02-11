<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipos
 *
 * @ORM\Table(name="equipos")
 * @ORM\Entity
 */
class Equipos
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nombre = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="ciudad", type="string", length=20, nullable=true)
     */
    private $ciudad;

    /**
     * @var string|null
     *
     * @ORM\Column(name="conferencia", type="string", length=4, nullable=true)
     */
    private $conferencia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="division", type="string", length=9, nullable=true)
     */
    private $division;


}
