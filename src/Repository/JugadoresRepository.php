<?php

namespace App\Repository;
use App\Entity\Equipos;
use Doctrine\ORM\EntityRepository;

class JugadoresRepository extends EntityRepository
{
    // D
    public function findPlayersByTeamName(Equipos $teamName){
        $dql = "SELECT j FROM App:Jugadores j WHERE j.nombreEquipo = :teamName";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('teamName', $teamName);

        return $query->getArrayResult();
    }

    // E
    public function findListOfPlayers(){
        $dql = "SELECT j FROM App:Jugadores j";
        $query = $this->getEntityManager()->createQuery($dql);

        return $query->getArrayResult();
    }

    // F
    public function findInfoOfAPlayer($playerName){
        $dql = "SELECT j FROM App:Jugadores j WHERE j.nombre = :playerName";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('playerName', $playerName);

        return $query->getArrayResult();
    }
}