<?php

namespace App\Repository;
use App\Entity\Jugadores;
use Doctrine\ORM\EntityRepository;

class EstadisticasRepository extends EntityRepository
{
    // H
    public function findStatsOfAPlayer(Jugadores $playerName){
        $dql = "SELECT e.puntosPorPartido,
                e.asistenciasPorPartido,
                e.taponesPorPartido,
                e.rebotesPorPartido
                FROM App:Estadisticas e
                WHERE e.jugador = :idPlayer";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('idPlayer', $playerName->getCodigo());

        return $query->getArrayResult();
    }

    // I: in option 1 (discarded) I reused previous method findStatsOfAPlayer()
    public function findAverageStatsOfAPlayer(Jugadores $playerName){
        $dql = "SELECT round(avg(e.puntosPorPartido), 2) AS averagePoints,
                round(avg(e.asistenciasPorPartido), 2) AS averageAssists,
                round(avg(e.taponesPorPartido), 2) AS averageBlocks,
                round(avg(e.rebotesPorPartido), 2) AS averageRebounds
                FROM App:Estadisticas e
                WHERE e.jugador = :idPlayer";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('idPlayer', $playerName->getCodigo());

        return $query->getArrayResult();
    }
}