<?php

namespace BK\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class SearchType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options)
	{


		$prix = array();
		$maxPrixValue = 100000;

		foreach(range(0, $maxPrixValue, 10000) as $i)
		{
			$prix[$i] = $i;
		}

	$builder

->add('category', 'choice',  array(
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
		'required' 	   => false
			))	
			
		/*->add('category', new CategoryType(), array('required' => false) )*/
			
		->add('titre', 'text', array('required' => false, 'attr' => array( 'placeholder' => 'Que recherchez-vous ?',)))
		->add('ville', 'text', array('required' => false, 'attr' => array( 'placeholder' => 'Ville ou code postal',)))
		->add('prix', 'choice', array('required' => false,     'choices' => $prix, 'placeholder' => 'Prix Min',))
		->add('prix_Max', 'choice', array('required' => false, 'choices' => $prix, 'placeholder' => 'Prix Max',))
		->add('rechercher', 'submit')
		;
		
		
	}
	
	public function getName()
    {
        return 'bk_platformbundle_search';
    }

}