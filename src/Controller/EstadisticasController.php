<?php

namespace App\Controller;
use App\Entity\Estadisticas;
use App\Entity\Jugadores;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EstadisticasController extends AbstractController
{
    // H
    public function statsOfAPlayer(Request $request){
        $inputPlayer = $request->get('playerName');
        $players = $this->getDoctrine()->getManager()->getRepository(Jugadores::class)
            ->findOneBy(["nombre" => $inputPlayer]);
        $player = $this->getDoctrine()->getManager()->getRepository(Estadisticas::class)
            ->findStatsOfAPlayer($players);

        foreach ($player as $stat){
            $season = $stat["temporada"];
            array_shift($stat);
            array_pop($stat);
            $arrayPlayer[$players->getNombre()]["Season: " . $season]=$stat;
        }

        return new JsonResponse($arrayPlayer);
    }

    // I
    public function averageStatsOfAPlayer(Request $request){

        return new JsonResponse();
    }
}