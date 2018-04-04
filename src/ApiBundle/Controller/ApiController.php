<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use ActualiteBundle\Entity\Actualite;

class ApiController extends Controller
{

    public function getAllActualitesAction()
    {

        header("Access-Control-Allow-Origin: *");

        $actualites = $this->getDoctrine()
                           ->getRepository('ActualiteBundle:Actualite')
                           ->getAllActualitesApi();

        return new JsonResponse($actualites);

    }

}
