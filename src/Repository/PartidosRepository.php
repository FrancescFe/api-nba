<?php

namespace App\Repository;
use App\Entity\Equipos;
use App\Entity\Partidos;
use Doctrine\ORM\EntityRepository;

class PartidosRepository extends EntityRepository
{
    // J: discarded
    public function findHomeResultsOfATeam(Partidos $homeTeamName){
        $dql = "SELECT p.temporada, p.equipoVisitante, 
                p.puntosLocal, p.puntosVisitante 
                FROM App:Partidos p
                WHERE p.equipoLocal = :homeTeamName";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('homeTeamName', $homeTeamName);

        //Query SQL that works
        /*SELECT p.temporada, p.puntos_local, p.puntos_visitante
FROM partidos AS p
WHERE equipo_local LIKE 'Raptors';*/


        return $query->getArrayResult();
    }
    // K: we just work in PartidosController

    // L
    public function findAverageHomePointReceivedOfATeam(Equipos $homeTeamName){
        $dql = "SELECT sum(p.puntosVisitante)/count(p.puntosVisitante) 
                FROM App:Partidos p
                WHERE p.equipoLocal = :homeTeamName";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('homeTeamName', $homeTeamName);

        return $query->getArrayResult();
    }


    // M

}