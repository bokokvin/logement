<?php

namespace BK\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;


class AnnonceRepository extends EntityRepository
{

		public function findOffreByParametres($data)

		{
			
			$query = $this->createQueryBuilder('a');
			$query->where('a.type = :type')
			
			->setParameter('type', 'Offres');


			if($data['titre'] != '')
			{
				$query->andWhere('a.titre LIKE :titre')
				->setParameter('titre', '%'.$data['titre'].'%');
			}

			if($data['category'] != '')
			{
				$query->andWhere('a.category = :category')
				->setParameter('category', $data['category']);
			}


			if($data['ville'] != '')
			{
				$query->andWhere('a.ville = :ville')
				->setParameter('ville', $data['ville']);
			}
			
			if($data['prix'] != '' AND $data['prix_Max'] != '')
			{
				$query->andWhere('a.prix BETWEEN :prixMin AND :prixMax')
				->setParameters(array(
					'prixMin' => $data['prix'],
					'prixMax' => $data['prix_Max']));
			}

			
			return $query->getQuery()->getResult();

		}
		
		
		public function findOffreByVille($ville)

		{
			$query = $this->createQueryBuilder('a');
			$query->where('a.ville = :ville')
					->setParameter('ville', $ville);
			
			return $query->getQuery()->getResult();
		}
		
		public function findOffre()

		{
			$query = $this->createQueryBuilder('a');
			$query->where('a.type = :type')
				//  ->andWhere('a.ville = :ville')
						
			
			->setParameter('type', 'Offres');
			//->setParameter('ville', '');
			
			return $query->getQuery()->getResult();
			
		}
		
		
		public function findDemandeByParametres($data)

		{

			/*$query = $this->createQueryBuilder('a');
			$query->where('a.prix BETWEEN :prixMin AND :prixMax')
			
			->setParameters(array(
			'prixMin' => $data['prix'],
			'prixMax' => $data['prix_Max']));*/
			
			$query = $this->createQueryBuilder('a');
			$query->where('a.type = :type')
			
			->setParameter('type', 'Demandes');


			if($data['titre'] != '')
			{
				$query->andWhere('a.titre LIKE :titre')
				->setParameter('titre', '%'.$data['titre'].'%');
			}

			if($data['category'] != '')
			{
				$query->andWhere('a.category = :category')
				->setParameter('category', $data['category']);
			}


			if($data['ville'] != '')
			{
				$query->andWhere('a.ville = :ville')
				->setParameter('ville', $data['ville']);
			}
			
			if($data['prix'] != '' AND $data['prix_Max'] != '')
			{
				$query->andWhere('a.prix BETWEEN :prixMin AND :prixMax')
				->setParameters(array(
					'prixMin' => $data['prix'],
					'prixMax' => $data['prix_Max']));
			}

			
			return $query->getQuery()->getResult();

		}
		
		public function findDemande()

		{
			$query = $this->createQueryBuilder('a');
			$query->where('a.type = :type')
				//  ->andWhere('a.ville = :ville')
						
			
			->setParameter('type', 'Demandes');
			//->setParameter('ville', 'aa');
			
			return $query->getQuery()->getResult();
			
		}
		
}