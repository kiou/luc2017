<?php

namespace CompetenceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CompetenceBundle\Form\CompetenceType;
use CompetenceBundle\Entity\Competence;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CompetenceController extends Controller
{

    /**
     * Ajouter une compétence
     */
    public function ajouterAdminAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $competence = new Competence;
        $form = $this->get('form.factory')->create(CompetenceType::class, $competence);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $competence->uploadImage();

            $em->persist($competence);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Compétence enregistrée avec succès');
            return $this->redirect($this->generateUrl('admin_competence_manager'));
        }

        return $this->render('CompetenceBundle:Admin:ajouter.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * Gestion des compétences
     */
    public function managerAdminAction(Request $request)
    {
        /* Services */
        $rechercheService = $this->get('recherche.service');
        $recherches = $rechercheService->setRecherche('competence_manager', array(
                'recherche',
            )
        );

        /* La liste des actualités */
        $competences = $this->getDoctrine()
                            ->getRepository('CompetenceBundle:Competence')
                            ->getAllCompetences($recherches['recherche']);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $competences, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            50/*limit per page*/
        );

        return $this->render('CompetenceBundle:Admin:manager.html.twig',array(
                'pagination' => $pagination,
                'recherches' => $recherches
            )
        );
    }

    /**
     * Supprimer une compétence
     */
    public function supprimerAdminAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $competence = $this->getDoctrine()
                           ->getRepository('CompetenceBundle:Competence')
                           ->find($id);

        $this->get('action.service')->ifIsset($competence);

        $em->remove($competence);
        $em->flush();

        $request->getSession()->getFlashBag()->add('succes', 'Compétence supprimée avec succès');
        return $this->redirect($this->generateUrl('admin_competence_manager'));
    }

    /**
     * Publication dépublication
     */
    public function publierAdminAction(Request $request, $id){

        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();

            $competence = $this->getDoctrine()
                               ->getRepository('CompetenceBundle:Competence')
                               ->find($id);

            $state = $competence->reverseState();

            $competence->setIsActive($state);
            $em->flush();

            return new JsonResponse(array('state' => $state));
        }

    }

    /**
     * Modifier une compétence
     */
    public function modifierAdminAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $competence = $this->getDoctrine()
                          ->getRepository('CompetenceBundle:Competence')
                          ->find($id);

        $this->get('action.service')->ifIsset($competence);

        $form = $this->get('form.factory')->create(CompetenceType::class, $competence);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $competence->uploadImage();

            $em->persist($competence);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Compétence enregistrée avec succès');
            return $this->redirect($this->generateUrl('admin_competence_manager'));
        }

        /* BreadCrumb */
        $breadcrumb = array(
            'Accueil' => $this->generateUrl('admin_page_index'),
            'Gestion des compétences' => $this->generateUrl('admin_competence_manager'),
            'Modifier une compétence' => ''
        );

        return $this->render('CompetenceBundle:Admin:modifier.html.twig',
            array(
                'breadcrumb' => $breadcrumb,
                'competence' => $competence,
                'form' => $form->createView()
            )
        );

    }


}
