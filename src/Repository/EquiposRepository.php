<?php

namespace App\Repository;
use App\Entity\Equipos;
use \Doctrine\ORM\EntityRepository;

class EquiposRepository extends EntityRepository
{
    public function findListOfTeams(){
        $dql = "SELECT e FROM App:Equipos e";
        $query = $this->getEntityManager()->createQuery($dql);

        return $query->getArrayResult();
    }

    public function findInfoOfATeam($teamName){
        $dql = "SELECT e FROM App:Equipos e WHERE e.nombre = :teamName";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('teamName', $teamName);

        return $query->getArrayResult();
    }

    public function findPlayersByTeams(){
        $dql = "SELECT e FROM App:Equipos e 
                GROUP_CONCAT(SELECT j.nombre FROM App:Jugadores j)";
        $query = $this->getEntityManager()->createQuery($dql);

        return $query->getArrayResult();
    }

    public function findPlayersByATeam($teamName){
        $dql = "SELECT e FROM App:Equipos e 
                GROUP_CONCAT(SELECT j.nombre FROM App:Jugadores j)
                WHERE e.nombre = :teamName";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('teamName', $teamName);

        return $query->getArrayResult();
    }
}