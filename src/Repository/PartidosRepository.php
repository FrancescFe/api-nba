<?php

namespace App\Repository;
use App\Entity\Equipos;
use App\Entity\Partidos;
use Doctrine\ORM\EntityRepository;

class PartidosRepository extends EntityRepository
{
    // J
    public function findHomeResultsOfATeam(Equipos $homeTeamName){
        $dql = "SELECT p.temporada, p.equipoLocal, p.equipoVisitante, 
                p.puntosLocal, p.puntosVisitante FROM App:Partidos p
                JOIN App:Equipos e
                ON p.equipoLocal = e.nombre
                WHERE p.equipoLocal = :homeTeamName";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('homeTeamName', $homeTeamName);

        return $query->getArrayResult();
    }
    // K: we just work in PartidosController

    // L: we just work in PartidosController

    // M: we just work in PartidosController

}