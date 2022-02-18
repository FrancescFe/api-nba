<?php

namespace App\Controller;
use App\Entity\Partidos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PartidosController extends AbstractController
{
    // J
    public function homeResultsOfATeam(Request $request){
        $inputTeam = $request->get('teamName');
        $teamHome = $this->getDoctrine()->getManager()->getRepository(Partidos::class)
            ->findOneBy(["equipoLocal" => $inputTeam]);
        $matchesTeam = $this->getDoctrine()->getManager()->getRepository(Partidos::class)
            ->findHomeResultsOfATeam($teamHome);

        foreach ($matchesTeam as $matchesStats){
            $season = $matchesStats["temporada"];
            $arrayMatches[$matchesTeam->getEquipoLocal()][]=$matchesTeam;
        }


        return new JsonResponse($arrayMatches);
    }

    // K
    public function awayResultsOfATeam(Request $request){


    }

    // L
    public function averageHomePointReceivedOfATeam(Request $request){


    }

    // M
    public function averageAwayPointReceivedOfATeam(Request $request){


    }

}