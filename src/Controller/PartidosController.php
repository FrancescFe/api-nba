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

        return new JsonResponse($teamHome);
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