<?php

namespace App\Repository;
use Doctrine\ORM\EntityRepository;

class JugadoresRepository extends EntityRepository
{
    public function findListOfPlayers(){
        $dql = "SELECT j FROM App:Jugadores j";
        $query = $this->getEntityManager()->createQuery($dql);

        return $query->getArrayResult();
    }

    public function findInfoOfAPlayer($playerName){
        $dql = "SELECT j FROM App:Jugadores j WHERE j.nombre = :playerName";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('playerName', $playerName);

        return $query->getArrayResult();
    }
}