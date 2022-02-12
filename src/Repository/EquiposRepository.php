<?php

namespace App\Repository;
use \Doctrine\ORM\EntityRepository;

class EquiposRepository extends EntityRepository
{
    public function findListOfEquipos(){
        $dql = "SELECT e FROM App:Equipos e";
        $query = $this->getEntityManager()->createQuery($dql);

        return $query->getArrayResult();
    }
}