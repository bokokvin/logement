<?php

namespace BK\PlatformBundle\Controller;

use BK\PlatformBundle\Entity\Annonce;
use BK\PlatformBundle\Form\AnnonceType;
use BK\PlatformBundle\Form\SearchType;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;




class GestionController extends Controller
{
    
	public function staticAction($page, $data)
    {
	
		if ($data == null)
		{
			return $this->render('BKPlatformBundle::'.$page.'.html.twig'
			);
		}
		else
		{
			return $this->render('BKPlatformBundle::'.$page.'.html.twig', array(
								'data' => $data
			));
		}
		
    }
	
	public function accueilAction()
    {
		/*$tout=array();
		$tout["ville"]="tout";*/
        return $this->render('BKPlatformBundle::accueil2.html.twig'/* array(
							'tout' => $tout
		)*/);
    }
	
	public function profilAction()
    {
        return $this->render('BKUserBundle::profil.html.twig');
    }
	
	public function mesAnnoncesAction()
    {
		$user = $this->get('security.context')->isGranted('ROLE_USER');
		
		if( !$user )
		{
			return $this->render('BKUserBundle:Security:login_content.html.twig');
		}
		else
		{
			return $this->render('BKPlatformBundle::mes_annonces.html.twig');
		}
    }
	
	
	/**
	 * @Route("/affich_annonce/{id}")
	 * @ParamConverter("annonce", class="BKPlatformBundle:Annonce")
	 */
	public function affichAnnonceAction(Annonce $annonce)
    {
		
		return $this->render('BKPlatformBundle::affich_annonce.html.twig', 
							array('tab' => $annonce
				));
    }
	
	public function connexionAction()
    {	
		
			return $this->render('BKPlatformBundle::connexion3.html.twig');
    }

	
	
	public function offreAction(Request $request/*, $ville*/)
	{
		$liste_annonces = array();
		$tab = array();
		
		$form 			 = $this->get('form.factory')->create(new SearchType() );
		$em   = $this->getDoctrine()->getManager();

		if($request->isMethod('POST'))
		{
			$form->handleRequest($request);
			
				$data = $form->getData();
				
				
				$liste_annonces = $em->getRepository('BKPlatformBundle:Annonce')->findOffreByParametres($data);
				
				return $this->render('BKPlatformBundle::offres.html.twig', 
					array(	'form' => $form->createView(),
							'liste_annonces' => $liste_annonces
		));

		}
		
		$liste_annonces = $em->getRepository('BKPlatformBundle:Annonce')->findOffre();
			
					return $this->render('BKPlatformBundle::offres.html.twig', 
						array(	'form' => $form->createView(),
								'liste_annonces' => $liste_annonces
			));

	
		/*if ( $ville == 'tout' )
		{
			$liste_annonces = $em->getRepository('BKPlatformBundle:Annonce')->findOffre();
			
					return $this->render('BKPlatformBundle::offres.html.twig', 
						array(	'form' => $form->createView(),
								'liste_annonces' => $liste_annonces
			));
		}
		else
		{
			$liste_annonces = $em->getRepository('BKPlatformBundle:Annonce')->findOffreByVille($ville);

			return $this->render('BKPlatformBundle::offres.html.twig', 
			array('form' => $form->createView(),
			'liste_annonces' => $liste_annonces
			));
		}*/
}




	public function demandeAction(Request $request)
	{
		$liste_annonces = array();
		$form 			 = $this->get('form.factory')->create(new SearchType() );
		$em   = $this->getDoctrine()->getManager();

		if($request->isMethod('POST'))
		{
			$form->handleRequest($request);
			
				$data = $form->getData();
				
				
				
				$liste_annonces = $em->getRepository('BKPlatformBundle:Annonce')->findDemandeByParametres($data);
				
				return $this->render('BKPlatformBundle::offres.html.twig', 
					array(	'form' => $form->createView(),
							'liste_annonces' => $liste_annonces
		));

		}
	
	
		$liste_annonces = $em->getRepository('BKPlatformBundle:Annonce')->findDemande();
		
		return $this->render('BKPlatformBundle::offres.html.twig', 
		array('form' => $form->createView(),
		'liste_annonces' => $liste_annonces
		));
	
}
		
    
	
	
	
	
	public function ajouterAction(Request $request)
	{
	
	$user = $this->get('security.context')->isGranted('ROLE_USER');
		
		if( !$user )
		{
			return $this->render('BKUserBundle:Security:login_content.html.twig');
		}
		
		else
		{
			
    
			$annonce         = new Annonce();
			$securityContext = $this->container->get('security.context');
			$form            = $this->get('form.factory')->create(AnnonceType::class, $annonce);
			$user = $this->container->get('security.token_storage')->getToken()->getUser();
			
			if ($request->isMethod('POST')) {
				$form->handleRequest($request);

				if ($form->isValid()) 
				{
				
				$annonce->setUser($user);
				
				
				$em = $this->getDoctrine()->getManager();
				$em->persist($annonce);
				$em->flush();

				$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

			   
				return $this->redirectToRoute('bk_platform_homepage');

				}
			}
			
			return $this->render('BKPlatformBundle::ajouter.html.twig', array(
			  'form' => $form->createView(),
			));
			
		}
	}
	
	
	public function sauverAnnonceAction($id)
	{
		$save         	 = new Enregistrement();
		$em 			 = $this->getDoctrine()->getManager();
		$securityContext = $this->container->get('security.context');
		
		$user 		= $this->container->get('security.token_storage')->getToken()->getUser();
		$annonce 	= $em->getRepository('BKPlatformBundle:Annonce')->find($id);
		
		$save->setUser($user);
		$save->setUser($annonce);
		
		$em->persist($annonce);
	    $em->flush();
		
		return $this->redirect($this->generateUrl('bk_platform_homepage'));
		
		
		
		
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
