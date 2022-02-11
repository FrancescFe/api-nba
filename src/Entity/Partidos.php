<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partidos
 *
 * @ORM\Table(name="partidos", indexes={@ORM\Index(name="equipo_local", columns={"equipo_local"}), @ORM\Index(name="equipo_visitante", columns={"equipo_visitante"})})
 * @ORM\Entity
 */
class Partidos
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
     * @var int|null
     *
     * @ORM\Column(name="puntos_local", type="integer", nullable=true)
     */
    private $puntosLocal;

    /**
     * @var int|null
     *
     * @ORM\Column(name="puntos_visitante", type="integer", nullable=true)
     */
    private $puntosVisitante;

    /**
     * @var string|null
     *
     * @ORM\Column(name="temporada", type="string", length=5, nullable=true)
     */
    private $temporada;

    /**
     * @var Equipos
     *
     * @ORM\ManyToOne(targetEntity="Equipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipo_local", referencedColumnName="nombre")
     * })
     */
    private $equipoLocal;

    /**
     * @var Equipos
     *
     * @ORM\ManyToOne(targetEntity="Equipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipo_visitante", referencedColumnName="nombre")
     * })
     */
    private $equipoVisitante;


}
