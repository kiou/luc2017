<?php

namespace GlobalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ContactBundle\Form\ContactType;
use ContactBundle\Entity\Contact;

class GlobalController extends Controller
{
    /**
     * L'index du site
     */
    public function ClientIndexAction()
    {

        $projets = $this->getDoctrine()
                        ->getRepository('ProjetBundle:Projet')
                        ->findBy(array('avant' => true, 'isActive' => true),array('id' => 'DESC'));

        $competences = $this->getDoctrine()
                            ->getRepository('CompetenceBundle:Competence')
                            ->findBy(array('isActive' => true),array('id' => 'DESC'));

        $actualites = $this->getDoctrine()
                           ->getRepository('ActualiteBundle:Actualite')
                           ->findBy(array('avant' => true, 'isActive' => true),array('poid' => 'DESC'));

        $contact = new Contact;
        $form = $this->get('form.factory')->create(ContactType::class, $contact);

        return $this->render('GlobalBundle:Client:index.html.twig',array(
                'projets' => $projets,
                'competences' => $competences,
                'actualites' => $actualites,
                'form' => $form->createView()
            )
        );
    }

    /**
     * L'index de l'administration
     */
    public function AdminIndexAction()
    {
        return $this->render('GlobalBundle:Admin/Page:index.html.twig');
    }

}
