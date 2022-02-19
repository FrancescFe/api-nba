<?php

namespace App\Controller;
use App\Entity\Equipos;
use App\Entity\Partidos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PartidosController extends AbstractController
{
    // J
    public function homeResultsOfATeam(Request $request){
        /*$inputTeam = $request->get('homeTeamName');
        $teams = $this->getDoctrine()->getManager()->getRepository(Equipos::class)
            ->findOneBy(["nombre" => $inputTeam]);
        $matches = $this->getDoctrine()->getManager()->getRepository(Partidos::class)
            ->findBy(["equipoLocal" => $teams]);

        $arrayMatches = [];
        $arrayMatch = [];

        foreach ($matches as $match){
            foreach ($match as $matchStat){
                $arrayMatch[$matchStat->getTemporada()][$match->getEquipoLocal()->getNombre()]
                    =$match->getPuntosLocal();
                $arrayMatch[$matchStat->getTemporada()][$match->getEquipoVisitante()->getNombre()]
                    =$match->getPuntosVisitante();
            }
            $arrayMatches = $arrayMatch;
        }

        return new JsonResponse($arrayMatches);*/

        $inputTeam = $request->get('homeTeamName');
        $teams = $this->getDoctrine()->getManager()->getRepository(Partidos::class)
            ->findHomeResultsOfATeam($inputTeam);

        return new JsonResponse($teams);

    }

    // K
    public function awayResultsOfATeam(Request $request){


    }

    // L
    public function averageHomePointReceivedOfATeam(Request $request){
        $inputTeam = $request->get('homeTeamName');
        $teams = $this->getDoctrine()->getManager()->getRepository(Equipos::class)
            ->findOneBy(["nombre" => $inputTeam]);
        $matches = $this->getDoctrine()->getManager()->getRepository(Partidos::class)
            ->findBy(["equipoLocal" => $teams]);
        $arrayMatches = [];

        foreach ($matches as $matchStats){
            $arrayMatches[$teams->getNombre()][$matchStats->getPuntosLocal()]=$matchStats->getPuntosLocal();
        }

        return new JsonResponse($arrayMatches);
    }

    // M
    public function averageAwayPointReceivedOfATeam(Request $request){


    }

}