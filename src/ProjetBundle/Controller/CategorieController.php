<?php

namespace ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjetBundle\Form\CategorieType;
use ProjetBundle\Entity\Categorie;

class CategorieController extends Controller
{

    /**
     * Gestion des catégories
     */
    public function managerAdminAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $categorie = new Categorie;
        $form = $this->get('form.factory')->create(CategorieType::class, $categorie);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){

            $em->persist($categorie);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Catégorie enregistrée avec succès');
            return $this->redirect($this->generateUrl('admin_projetcategorie_manager'));
        }

        $categories = $this->getDoctrine()
                           ->getRepository('ProjetBundle:Categorie')
                           ->findBy(array(),array('id' => 'DESC'));

        return $this->render('ProjetBundle:Admin/Categorie:manager.html.twig',array(
                'form' => $form->createView(),
                'categories' => $categories,
            )
        );
    }

    /**
     * Supprimer une catégorie
     */
    public function supprimerAdminAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $categorie = $this->getDoctrine()
                          ->getRepository('ProjetBundle:Categorie')
                          ->find($id);

        if(count($categorie->getProjets()) != 0){
            header('HTTP/1.0 404 Not Found');
            die();
        }

        $this->get('action.service')->ifIsset($categorie);

        $em->remove($categorie);
        $em->flush();

        $request->getSession()->getFlashBag()->add('succes', 'Catégorie supprimée avec succès');
        return $this->redirect($this->generateUrl('admin_projetcategorie_manager'));
    }

    /**
     * Modifier une catégorie
     */
    public function modifierAdminAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $categorie = $this->getDoctrine()
                          ->getRepository('ProjetBundle:Categorie')
                          ->find($id);

        $this->get('action.service')->ifIsset($categorie);

        $form = $this->get('form.factory')->create(CategorieType::class, $categorie);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $em->persist($categorie);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Catégorie enregistrée avec succès');
            return $this->redirect($this->generateUrl('admin_projetcategorie_manager'));
        }

        /* BreadCrumb */
        $breadcrumb = array(
            'Accueil' => $this->generateUrl('admin_page_index'),
            'Gestion des catégories' => $this->generateUrl('admin_projetcategorie_manager'),
            'Modifier une catégorie' => ''
        );

        return $this->render('ProjetBundle:Admin/Categorie:modifier.html.twig',
            array(
                'breadcrumb' => $breadcrumb,
                'categorie' => $categorie,
                'form' => $form->createView()
            )
        );

    }

}
