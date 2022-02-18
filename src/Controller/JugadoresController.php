<?php

namespace App\Controller;
use App\Entity\Equipos;
use App\Entity\Jugadores;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class JugadoresController extends AbstractController
{
    // C
    public function playersByTeams(){
        $teams = $this->getDoctrine()->getManager()->getRepository(Jugadores::class)->findAll();
        $arrayTeams = [];

        foreach ($teams as $aTeam){
            $arrayTeams[$aTeam->getNombreEquipo()->getNombre()][]=$aTeam->getNombre();
        }

        return new JsonResponse($arrayTeams);
    }

    // D
    public function playersByTeamName(Request $request){
        $inputTeam = $request->get('teamName');
        $teams = $this->getDoctrine()->getManager()->getRepository(Equipos::class)->findOneBy(["nombre" => $inputTeam]);
        $team = $this->getDoctrine()->getManager()->getRepository(Jugadores::class)->findPlayersByTeamName($teams);

        return new JsonResponse($team);
    }

    // E
    public function listOfPlayers(){
        $players = $this->getDoctrine()->getManager()->getRepository(Jugadores::class)->findListOfPlayers();

        return new JsonResponse($players);
    }

    // F
    public function infoOfAPlayer(Request $request){
        $aPlayer = $request->get('playerName');

        $players = $this->getDoctrine()->getManager()->getRepository(Jugadores::class)->findInfoOfAPlayer($aPlayer);

        return new JsonResponse($players);
    }

    // G
    public function heightWeightPositionOfAPlayer(Request $request){
        $inputPlayer = $request->get('playerName');
        $player = $this->getDoctrine()->getManager()->getRepository(Jugadores::class)->
                    findOneBy(["nombre"=>$inputPlayer]);
        $arrayStats = [];

        $height = explode("-", $player->getAltura());
        $player->setAltura((($height[0]*12)+$height[1])*2.54);
        $weight = $player->getPeso();
        $player->setPeso($weight*0.453592);

        $arrayStats["height(cm)"]=$player->getAltura();
        $arrayStats["weight(kg)"]=$player->getPeso();
        $arrayStats["fieldPosition"]=$player->getPosicion();

        $arrayPlayerStats[$player->getNombre()]=$arrayStats;

        return new JsonResponse($arrayPlayerStats);
    }
}