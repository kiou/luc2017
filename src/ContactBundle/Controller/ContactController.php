<?php

namespace ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use ContactBundle\Form\ContactType;
use ContactBundle\Entity\Contact;

class ContactController extends Controller
{

    /**
     * Gestion des contacts
     */
    public function managerAdminAction()
    {
        $contacts = $this->getDoctrine()
                         ->getRepository('ContactBundle:Contact')
                         ->findBy(array(),array('id' => 'DESC'));

        return $this->render('ContactBundle:Admin:manager.html.twig',array(
                'contacts' => $contacts
            )
        );
    }

    /* Traitement du formulaire de contact */
    public function PostContactAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $contact = new Contact;
        $form = $this->get('form.factory')->create(ContactType::class, $contact);

        if($request->isXmlHttpRequest()) {

            /* Récéption du formulaire */
            if ($form->handleRequest($request)->isValid()){
                $em->persist($contact);
                $em->flush();

                /* Notification */

                return new JsonResponse(array(
                        'succes' => 'Votre message à été envoyé avec succès'
                    )
                );
            }

            return new JsonResponse(array(
                    'error' => $this->getErrorsAsArray($form)
                )
            );

        }

    }

    /**
     * Retourne un tableau d'erreur pour le formulaired
     * @param Object le formulaire
     */
    protected function getErrorsAsArray($form)
    {
        $errors = array();
        foreach ($form->getErrors() as $error)
            $errors[] = $error->getMessage();

        foreach ($form->all() as $key => $child) {
            if ($err = $this->getErrorsAsArray($child))
                $errors[$key] = $err;
        }
        return $errors;
    }

}
