<?php

namespace ProjetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre', TextType::class)
                ->add('lien', UrlType::class)
                ->add('fileimage', FileType::class)
                ->add('fileimageavant', FileType::class)
                ->add('avant', ChoiceType::class,array(
                        'choices' => array(
                            'Oui' => true,
                            'Non' => False
                        ),
                        'expanded' => true
                    )
                )
                ->add('categorie', EntityType::class, array(
                        'class' => 'ProjetBundle:Categorie',
                        'choice_label' => 'nom',
                        'placeholder' => 'Choisir une catégorie'
                    )
                )
                ->add('contenu', TextareaType::class)
                ->add('Enregistrer', SubmitType::class, array(
                        'attr' => array('class' => 'form-submit turquoise medium')
                    )
                )
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjetBundle\Entity\Projet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projetbundle_projet';
    }


}
