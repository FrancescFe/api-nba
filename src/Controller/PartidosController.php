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
        //Try 1
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

        //try 2
        /*$inputTeam = $request->get('homeTeamName');
        $teams = $this->getDoctrine()->getManager()->getRepository(Partidos::class)
            ->findHomeResultsOfATeam($inputTeam);

        return new JsonResponse($teams);*/

        $inputName = $request->get('homeTeamName');
        $teams = $this->getDoctrine()->getManager()->getRepository(Equipos::class)
            ->findOneBy(['nombre' => $inputName]);
        $matches = $this->getDoctrine()->getManager()->getRepository(Partidos::class)
            ->findBy(['equipoLocal' => $inputName]);

        $homeMatches = [];

        foreach ($matches as $match){
            $homeMatches[$teams->getNombre()][] = $match->getEquipoLocal()->getNombre() .
                " " . $match->getPuntosLocal() . " " . $match->getEquipoVisitante()->
                    getNombre() . " " . $match->getPuntosVisitante();
        }

        return new JsonResponse($homeMatches);
    }

    // K
    public function awayResultsOfATeam(Request $request){
        $inputName = $request->get('awayTeamName');
        $teams = $this->getDoctrine()->getManager()->getRepository(Equipos::class)
            ->findOneBy(['nombre' => $inputName]);
        $matches = $this->getDoctrine()->getManager()->getRepository(Partidos::class)
            ->findBy(['equipoVisitante' => $inputName]);

        $awayMatches = [];

        foreach ($matches as $match){
            $awayMatches[$teams->getNombre()][] = $match->getEquipoLocal()->getNombre() .
                " " . $match->getPuntosLocal() . " " . $match->getEquipoVisitante()->
                getNombre() . " " . $match->getPuntosVisitante();
        }

        return new JsonResponse($awayMatches);
    }

    // L
    public function averageHomePointReceivedOfATeam(Request $request){
        $inputTeam = $request->get('homeTeamName');
        $teams = $this->getDoctrine()->getManager()->getRepository(Equipos::class)
            ->findOneBy(["nombre" => $inputTeam]);
        $matches = $this->getDoctrine()->getManager()->getRepository(Partidos::class)
            ->findAverageHomePointReceivedOfATeam($teams);

        return new JsonResponse($matches);
    }

    // M
    public function averageAwayPointReceivedOfATeam(Request $request){


    }

}