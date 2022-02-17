<?php

namespace App\Controller;
use App\Entity\Equipos;
use App\Entity\Jugadores;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EquipoController extends AbstractController
{
    // A
    public function listOfTeams(){
        $teams = $this->getDoctrine()->getManager()->getRepository(Equipos::class)->findListOfTeams();

        return new JsonResponse($teams);
    }

    // B
    public function infoOfATeam(Request $request){
        $inputTeam = $request->get('teamName');

        $teams = $this->getDoctrine()->getManager()->getRepository(Equipos::class)->findInfoOfATeam($inputTeam);

        return new JsonResponse($teams);
    }

}