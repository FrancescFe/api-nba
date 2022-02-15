<?php

namespace App\Controller;
use App\Entity\Jugadores;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class JugadoresController extends AbstractController
{
    public function listOfPlayers(){
        $players = $this->getDoctrine()->getManager()->getRepository(Jugadores::class)->findListOfPlayers();

        return new JsonResponse($players);
    }

    public function infoOfATeam(Request $request){
        $aPlayer = $request->get('playerName');

        $players = $this->getDoctrine()->getManager()->getRepository(Jugadores::class)->findInfoOfATeam($aPlayer);

        return new JsonResponse($players);
    }
}