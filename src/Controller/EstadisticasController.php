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
        $inputPlayer = $request->get('playerName');
        $players = $this->getDoctrine()->getManager()->getRepository(Jugadores::class)
            ->findOneBy(["nombre" => $inputPlayer]);
        $player = $this->getDoctrine()->getManager()->getRepository(Estadisticas::class)
            ->findStatsOfAPlayer($players);

        $averagePointsByMatch = 0;
        $averageAssistsByMatch = 0;
        $averageBlocksByMatch = 0;
        $averageReboundsByMatch = 0;
        $iterForEach=0;

        foreach ($player as $stat){
            array_shift($stat);
            array_pop($stat);
            $averagePointsByMatch += array_shift($stat);
            $averageAssistsByMatch += array_shift($stat);
            $averageBlocksByMatch += array_shift($stat);
            $averageReboundsByMatch += array_shift($stat);
            $iterForEach++;
        }

        $averagePointsByMatch = "averagePointsByMatch: " . round($averagePointsByMatch/$iterForEach,2);
        $averageAssistsByMatch = "averageAssistsByMatch: " . round($averageAssistsByMatch/$iterForEach, 2);
        $averageBlocksByMatch = "averageBlocksByMatch: " . round($averageBlocksByMatch/$iterForEach, 2);
        $averageReboundsByMatch = "averageReboundsByMatch: " . round($averageReboundsByMatch/$iterForEach, 2);

        $averageStats = [];
        array_push($averageStats, $averagePointsByMatch, $averageAssistsByMatch,
            $averageBlocksByMatch, $averageReboundsByMatch);

        $arrayPlayer[$players->getNombre()][]=$averageStats;

        return new JsonResponse($arrayPlayer);
    }
}