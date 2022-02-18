<?php

namespace App\Repository;
use App\Entity\Jugadores;
use Doctrine\ORM\EntityRepository;

class EstadisticasRepository extends EntityRepository
{
    // H
    public function findStatsOfAPlayer(Jugadores $playerName){
        $dql = "SELECT e FROM App:Estadisticas e WHERE e.jugador = :playerName";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('playerName', $playerName);

        return $query->getArrayResult();
    }

    // I
    public function findAverageStatsOfAPlayer(Jugadores $playerName){
        $dql = "SELECT e FROM App:Estadisticas e WHERE e.jugador = :playerName";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('playerName', $playerName);

        return $query->getArrayResult();
    }
}