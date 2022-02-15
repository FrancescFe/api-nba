<?php

namespace App\Controller;
use App\Entity\Equipos;
use App\Entity\Jugadores;
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

    public function playersByTeams(){
        $teams = $this->getDoctrine()->getManager()->getRepository(Equipos::class)->findAll();
        $arrayTeams = [];

        foreach ($teams as $aTeam){
            $players = $this->getDoctrine()->getManager()->getRepository(Jugadores::class)->
                        findBy(["nombreEquipo" => $aTeam]);
            $arrayPlayers = array();

            foreach ($players as $player){
                array_push($arrayPlayers, $player->getNombre());
            }
            $arrayTeams[$aTeam->getNombre()] = $arrayPlayers;
        }
        return new JsonResponse($arrayTeams);
    }

}