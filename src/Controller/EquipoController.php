<?php

namespace App\Controller;
use App\Entity\Equipos;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class EquipoController extends AbstractController
{
    public function listOfEquipos(){
        $equipos = $this->getDoctrine()->getManager()->getRepository(Equipos::class)
            ->findListOfEquipos();

        return new JsonResponse($equipos);
    }
}