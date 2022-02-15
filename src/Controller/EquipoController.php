<?php

namespace App\Controller;
use App\Entity\Equipos;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EquipoController extends AbstractController
{
    public function listOfTeams(){
        $teams = $this->getDoctrine()->getManager()->getRepository(Equipos::class)->findListOfTeams();

        return new JsonResponse($teams);
    }

    public function infoOfATeam(Request $request){
        $aTeam = $request->get('teamName');

        $teams = $this->getDoctrine()->getManager()->getRepository(Equipos::class)->findInfoOfATeam($aTeam);

        return new JsonResponse($teams);
    }
}