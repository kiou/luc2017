<?php

namespace ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjetBundle\Form\ProjetType;
use ProjetBundle\Entity\Projet;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProjetController extends Controller
{
    /**
     * Ajouter un projet
     */
    public function ajouterAdminAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $projet = new Projet;
        $form = $this->get('form.factory')->create(ProjetType::class, $projet);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $projet->uploadImage();
            $projet->uploadImageavant();

            $em->persist($projet);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'projet enregistré avec succès');
            return $this->redirect($this->generateUrl('admin_projet_manager'));
        }

        return $this->render('ProjetBundle:Admin:ajouter.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * Gestion des projets
     */
    public function managerAdminAction(Request $request)
    {
        /* Services */
        $rechercheService = $this->get('recherche.service');
        $recherches = $rechercheService->setRecherche('projet_manager', array(
                'recherche',
            )
        );

        /* La liste des projets */
        $projets = $this->getDoctrine()
                           ->getRepository('ProjetBundle:Projet')
                           ->getAllProjets($recherches['recherche']);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $projets, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            50/*limit per page*/
        );

        return $this->render('ProjetBundle:Admin:manager.html.twig',array(
                'pagination' => $pagination,
                'recherches' => $recherches
            )
        );
    }

    /**
     * Supprimer un projet
     */
    public function supprimerAdminAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $projet = $this->getDoctrine()
                       ->getRepository('ProjetBundle:Projet')
                       ->find($id);

        $this->get('action.service')->ifIsset($projet);

        $em->remove($projet);
        $em->flush();

        $request->getSession()->getFlashBag()->add('succes', 'Projet supprimé avec succès');
        return $this->redirect($this->generateUrl('admin_projet_manager'));
    }

    /**
     * Publication dépublication
     */
    public function publierAdminAction(Request $request, $id){

        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();

            $projet = $this->getDoctrine()
                            ->getRepository('ProjetBundle:Projet')
                            ->find($id);

            $state = $projet->reverseState();

            $projet->setIsActive($state);
            $em->flush();

            return new JsonResponse(array('state' => $state));
        }

    }

    /**
     * Modifier un projet
     */
    public function modifierAdminAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $projet = $this->getDoctrine()
                       ->getRepository('ProjetBundle:Projet')
                       ->find($id);

        $this->get('action.service')->ifIsset($projet);

        $form = $this->get('form.factory')->create(ProjetType::class, $projet);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $projet->uploadImage();
            $projet->uploadImageavant();

            $em->persist($projet);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Projet enregistré avec succès');
            return $this->redirect($this->generateUrl('admin_projet_manager'));
        }

        /* BreadCrumb */
        $breadcrumb = array(
            'Accueil' => $this->generateUrl('admin_page_index'),
            'Gestion des projets' => $this->generateUrl('admin_projet_manager'),
            'Modifier un projet' => ''
        );

        return $this->render('ProjetBundle:Admin:modifier.html.twig',
            array(
                'breadcrumb' => $breadcrumb,
                'projet' => $projet,
                'form' => $form->createView()
            )
        );

    }

    /**
     * Gestion des projets client
     */
    public function managerClientAction(Request $request)
    {

        $projets = $this->getDoctrine()
                        ->getRepository('ProjetBundle:Projet')
                        ->findBy(array('isActive' => true),array('poid' => 'DESC'));

        $categories = $this->getDoctrine()
                           ->getRepository('ProjetBundle:Categorie')
                           ->findBy(array(),array('id' => 'DESC'));

        return $this->render('ProjetBundle:Client:manager.html.twig',array(
                'projets' => $projets,
                'categories' => $categories
            )
        );
    }

}
