<?php

namespace ActualiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ActualiteBundle\Form\ActualiteType;
use ActualiteBundle\Entity\Actualite;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ActualiteController extends Controller
{

    /**
     * Ajouter une actualité
     */
    public function ajouterAdminAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $actualite = new Actualite;
        $form = $this->get('form.factory')->create(ActualiteType::class, $actualite);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $actualite->uploadImage();

            $em->persist($actualite);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Actualité enregistrée avec succès');
            return $this->redirect($this->generateUrl('admin_actualite_manager'));
        }

        return $this->render('ActualiteBundle:Admin:ajouter.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * Gestion des actualités
     */
    public function managerAdminAction(Request $request)
    {
        /* Services */
        $rechercheService = $this->get('recherche.service');
        $recherches = $rechercheService->setRecherche('actualite_manager', array(
                'recherche',
            )
        );

        /* La liste des actualités */
        $actualites = $this->getDoctrine()
                           ->getRepository('ActualiteBundle:Actualite')
                           ->getAllActualites($recherches['recherche']);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $actualites, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            50/*limit per page*/
        );

        return $this->render('ActualiteBundle:Admin:manager.html.twig',array(
                'pagination' => $pagination,
                'recherches' => $recherches
            )
        );
    }

    /**
     * Supprimer une actualité
     */
    public function supprimerAdminAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $actualite = $this->getDoctrine()
                          ->getRepository('ActualiteBundle:Actualite')
                          ->find($id);

        $this->get('action.service')->ifIsset($actualite);

        $em->remove($actualite);
        $em->flush();

        $request->getSession()->getFlashBag()->add('succes', 'Actualité supprimée avec succès');
        return $this->redirect($this->generateUrl('admin_actualite_manager'));
    }

    /**
     * Publication dépublication
     */
    public function publierAdminAction(Request $request, $id){

        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();

            $actualite = $this->getDoctrine()
                              ->getRepository('ActualiteBundle:Actualite')
                              ->find($id);

            $state = $actualite->reverseState();

            $actualite->setIsActive($state);
            $em->flush();

            return new JsonResponse(array('state' => $state));
        }

    }

    /**
     * Modifier une actualité
     */
    public function modifierAdminAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $actualite = $this->getDoctrine()
                          ->getRepository('ActualiteBundle:Actualite')
                          ->find($id);

        $this->get('action.service')->ifIsset($actualite);

        $form = $this->get('form.factory')->create(ActualiteType::class, $actualite);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $actualite->uploadImage();

            $em->persist($actualite);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Actualité enregistrée avec succès');
            return $this->redirect($this->generateUrl('admin_actualite_manager'));
        }

        /* BreadCrumb */
        $breadcrumb = array(
            'Accueil' => $this->generateUrl('admin_page_index'),
            'Gestion des actualités' => $this->generateUrl('admin_actualite_manager'),
            'Modifier une actualité' => ''
        );

        return $this->render('ActualiteBundle:Admin:modifier.html.twig',
            array(
                'breadcrumb' => $breadcrumb,
                'actualite' => $actualite,
                'form' => $form->createView()
            )
        );

    }

    /**
     * Gestion des actualités client
     */
    public function managerClientAction(Request $request)
    {

        $actualites = $this->getDoctrine()
                           ->getRepository('ActualiteBundle:Actualite')
                           ->findBy(array('isActive' => true),array('poid' => 'DESC'));

        return $this->render('ActualiteBundle:Client:manager.html.twig',array(
                'actualites' => $actualites
            )
        );
    }

    public function clientActualiteAction(Request $request, $id){

        $actualite = $this->getDoctrine()
                          ->getRepository('ActualiteBundle:Actualite')
                          ->find($id);

        return $this->render('ActualiteBundle:Client:view.html.twig',
            array(
                'actualite' => $actualite,
            )
        );

    }

}
