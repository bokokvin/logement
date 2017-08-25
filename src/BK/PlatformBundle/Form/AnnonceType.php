<?php

namespace BK\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use BK\UserBundle\Form\UserType;


class AnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
		->add('category', ChoiceType::class,  array(
		'choices' => 
					array('--Emploi--' => array(
						'Emploi' => 'Offres d\'emploi', ),
						
						'--Vehicules--' => array(
						'Voitures' => 'Voitures',
						'Moto' => 'Moto',
						'Caravaning' => 'Caravaning',
						'Utilitaires' => 'Utilitaires',
						'Equipements Auto' => 'Equipements Auto', ),
						
						'--Immobilier--' => array(
						'Location' => 'Location',
						'Colocation' => 'Colocation',
						'Ventes immobilières' => 'Ventes immobilières',
						'Bureaux' => 'Bureaux & Commerce', ),
						),
		'placeholder'  => '--Choisissez une categorie--',
			))
		->add('detenteur', ChoiceType::class,  array(
			
			'label'      => 'Vous êtes un *',
            'choices'    => array('Particulier' => 'Particulier', 'Professionnel' => 'Professionnel'),
            'expanded'   => true,
			'label_attr' => array( 'class' => 'checkbox-inline'),
			
			 
         ))
		
		->add('type', ChoiceType::class,  array(
			'label_attr' => array( 'class' => 'radio-inline'),
			 'label'    => 'Type d\'annonce',
             'choices'  => array('Offres' => 'Offres', 'Demandes' => 'Demandes'),
             'expanded' => true,
			 
         ))
		
		->add('titre', TextType::class,  array(
			 'label'    => 'Titre de l\'annonce',))
		
		->add('texte', TextareaType::class, array(
			 'label'    => 'Texte de l\'annonce',))
		->add('prix', TextType::class)
		->add('ville', TextType::class)
		->add('adresse', TextType::class)
		->add('image',      new ImageType())
	//	->add('category', new CategoryType() )
		->add('save', SubmitType::class);
		
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BK\PlatformBundle\Entity\Annonce'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bk_platformbundle_annonce';
    }


}
