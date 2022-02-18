<?php

namespace App\Controller;
use App\Entity\Estadisticas;
use App\Entity\Jugadores;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        $averagePoints = 0;
        $averageAssists = 0;
        $averageBlocks = 0;
        $averageRebounds = 0;
        $count=0;

        foreach ($player as $stat){
            array_shift($stat);
            array_pop($stat);
            $averagePoints += array_shift($stat);
            $averageAssists += array_shift($stat);
            $averageBlocks += array_shift($stat);
            $averageRebounds += array_shift($stat);
            $count++;
        }

        $averagePoints = "averagePointsByMatch: " . round($averagePoints/$count,2);
        $averageAssists = "averageAssistsByMatch: " . round($averageAssists/$count, 2);
        $averageBlocks = "averageBlocksByMatch: " . round($averageBlocks/$count, 2);
        $averageRebounds = "averageReboundsByMatch: " . round($averageRebounds/$count, 2);

        $averageStats = [];
        array_push($averageStats, $averagePoints, $averageAssists,
            $averageBlocks, $averageRebounds);

        $arrayPlayer[$players->getNombre()]=$averageStats;

        return new JsonResponse($arrayPlayer);
    }
}