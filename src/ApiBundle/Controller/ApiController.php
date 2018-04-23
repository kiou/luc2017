<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use ActualiteBundle\Entity\Actualite;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller
{

    /**
     * Retourne la liste des actualités
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllActualitesAction(Request $request)
    {
        $produits = [];
        $baseurl = $request->getScheme().'://'.$request->getHttpHost().$request->getBasePath().'/';

        header("Access-Control-Allow-Origin: *");

        $datas = $this->getDoctrine()
                      ->getRepository('ActualiteBundle:Actualite')
                      ->findBy(['isActive' => true],['id' => 'DESC']);

        foreach ($datas as $produit){
            array_push($produits, array(
                    'id' => $produit->getId(),
                    'created' => $produit->getCreated(),
                    'titre' => $produit->getTitre(),
                    'categorieId' => $produit->getCategorie()->getId(),
                    'categorie' => $produit->getCategorie()->getNom(),
                    'miniature' => $baseurl.'web/img/actualite/miniature/'.$produit->getImage(),
                    'image' => $baseurl.'web/img/actualite/tmp/'.$produit->getImage(),
                    'resume' => $produit->getResume(),
                    'contenu' => $produit->getContenu()
                )
            );
        }

        return new JsonResponse($produits);
    }

    /**
     * Retourne la liste des projets
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllProjetsAction(Request $request)
    {
        $projets = [];
        $baseurl = $request->getScheme().'://'.$request->getHttpHost().$request->getBasePath().'/';

        header("Access-Control-Allow-Origin: *");

        $datas = $this->getDoctrine()
                      ->getRepository('ProjetBundle:Projet')
                      ->findBy(['isActive' => true],['id' => 'DESC']);

        foreach ($datas as $projet){
            array_push($projets, array(
                    'id' => $projet->getId(),
                    'created' => $projet->getCreated(),
                    'titre' => $projet->getTitre(),
                    'categorieId' => $projet->getCategorie()->getId(),
                    'categorie' => $projet->getCategorie()->getNom(),
                    'liste' => $baseurl.'web/img/actualite/miniature/'.$projet->getImage(),
                    'contenu' => $projet->getContenu()
                )
            );
        }

        return new JsonResponse($projets);
    }

    /**
     * Retourne la liste des compétences
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllCompetencesAction(Request $request)
    {
        $competences = [];
        $baseurl = $request->getScheme().'://'.$request->getHttpHost().$request->getBasePath().'/';

        header("Access-Control-Allow-Origin: *");

        $datas = $this->getDoctrine()
                      ->getRepository('CompetenceBundle:Competence')
                      ->findBy(['isActive' => true],['id' => 'DESC']);

        foreach ($datas as $competence){
            array_push($competences, array(
                    'id' => $competence->getId(),
                    'created' => $competence->getCreated(),
                    'titre' => $competence->getTitre(),
                    'image' => $baseurl.'web/img/actualite/miniature/'.$competence->getImage(),
                    'contenu' => $competence->getContenu()
                )
            );
        }

        return new JsonResponse($competences);
    }

}
