<?php

namespace App\Repository;
use App\Entity\Partidos;
use Doctrine\ORM\EntityRepository;

class PartidosRepository extends EntityRepository
{
    // J
    public function findHomeResultsOfATeam(Partidos $teamName){
        $dql = "SELECT p FROM App:Partidos p WHERE p.equipoLocal = :teamName";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('teamName', $teamName);

        return $query->getArrayResult();
    }
}