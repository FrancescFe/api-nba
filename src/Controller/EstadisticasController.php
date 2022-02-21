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
        $playerStats = $this->getDoctrine()->getManager()->getRepository(Estadisticas::class)
            ->findStatsOfAPlayer($players);

        $statsBySeason[$players->getNombre()] = $playerStats;

        return new JsonResponse($statsBySeason);
    }

    // I
    public function averageStatsOfAPlayer(Request $request){
        $inputPlayer = $request->get('playerName');
        $players = $this->getDoctrine()->getManager()->getRepository(Jugadores::class)
            ->findOneBy(["nombre" => $inputPlayer]);
        $playerStats = $this->getDoctrine()->getManager()->getRepository(Estadisticas::class)
            ->findAverageStatsOfAPlayer($players);

        return new JsonResponse($playerStats);
    }
}