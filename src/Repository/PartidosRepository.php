<?php

namespace App\Repository;
use App\Entity\Equipos;
use App\Entity\Partidos;
use Doctrine\ORM\EntityRepository;

class PartidosRepository extends EntityRepository
{
    // J: we use PartidosController

    // K: we use PartidosController

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
    public function findAverageAwayPointReceivedOfATeam(Equipos $awayTeamName){
        $dql = "SELECT avg(p.puntosLocal) 
                FROM App:Partidos p
                WHERE p.equipoVisitante = :awayTeamName";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('awayTeamName', $awayTeamName);

        return $query->getArrayResult();
    }

}