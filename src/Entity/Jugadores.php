<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jugadores
 *
 * @ORM\Table(name="jugadores", indexes={@ORM\Index(name="Nombre_equipo", columns={"nombre_equipo"})})
 * @ORM\Entity
 */
class Jugadores
{
    /**
     * @var int
     *
     * @ORM\Column(name="codigo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codigo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="procedencia", type="string", length=20, nullable=true)
     */
    private $procedencia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="altura", type="string", length=4, nullable=true)
     */
    private $altura;

    /**
     * @var int|null
     *
     * @ORM\Column(name="peso", type="integer", nullable=true)
     */
    private $peso;

    /**
     * @var string|null
     *
     * @ORM\Column(name="posicion", type="string", length=5, nullable=true)
     */
    private $posicion;

    /**
     * @var Equipos
     *
     * @ORM\ManyToOne(targetEntity="Equipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nombre_equipo", referencedColumnName="nombre")
     * })
     */
    private $nombreEquipo;


}
