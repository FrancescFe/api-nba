<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estadisticas
 *
 * @ORM\Table(name="estadisticas", indexes={@ORM\Index(name="jugador", columns={"jugador"})})
 * @ORM\Entity
 */
class Estadisticas
{
    /**
     * @var string
     *
     * @ORM\Column(name="temporada", type="string", length=5, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $temporada;

    /**
     * @var float|null
     *
     * @ORM\Column(name="puntos_por_partido", type="float", precision=10, scale=0, nullable=true)
     */
    private $puntosPorPartido;

    /**
     * @var float|null
     *
     * @ORM\Column(name="asistencias_por_partido", type="float", precision=10, scale=0, nullable=true)
     */
    private $asistenciasPorPartido;

    /**
     * @var float|null
     *
     * @ORM\Column(name="tapones_por_partido", type="float", precision=10, scale=0, nullable=true)
     */
    private $taponesPorPartido;

    /**
     * @var float|null
     *
     * @ORM\Column(name="rebotes_por_partido", type="float", precision=10, scale=0, nullable=true)
     */
    private $rebotesPorPartido;

    /**
     * @var Jugadores
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Jugadores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jugador", referencedColumnName="codigo")
     * })
     */
    private $jugador;


}
