<?php
class ListeVolsController extends Zend_Controller_Action
{
	public function indexAction()
	{
		
	}
	public function ajoutAction()
	{
		//Instancie le form créer
		$formVol = new Application_Form_AjoutListeVols();
		//Instancie la classe créer
		$class_listevol = new Application_Model_TListeVols();
		
		if(!$this->getRequest()->getPost())
		{	
			
			//Envoie a la vue le form
			$this->view->assign('form_vol',$formVol);
		}
		else
		{
			// on récupère les données du formulaire
			$data = $this->getRequest()->getPost();
			//$formAjoutLigne->isValid($data);
			//Verif des donnée du formulaire
			if($formVol->isValid($data)==true)
			{
				// on récupère les infos du formulaire
				if(isset($data['heure_prevue_depart']) && isset($data['heure_prevue_arrivee']) && isset($data['periodicite']) && isset($data['id_ligne']) )
				{

					//AJOUT DANS LA BD
					$ajoutLigne = $class_listevol->createRow($data);
					$ajoutLigne->save();
					echo"Enregistrement effectuer";					
				}
			
				else
				{
					$formVol->populate($data);
					//Envoie a la vue le form
					$this->view->assign('form_vol',$formVol);
				}
			}
			else
			{
				$formVol->populate($data);
				//Envoie a la vue le form
				$this->view->assign('form_vol',$formVol);
			}
		}
	
	}
	
	public function supprAction()
	{
		
		//Instancie le form créer
		$formSupprListevol = new Application_Form_SupprListevol();
		//Instancie la classe créer
		
		$class_Listevols = new Application_Model_TListeVols();
		
		
		
		if(!$this->getRequest()->getPost())
		{
			//Envoie a la vue le form
			$this->view->assign('form_suppr_listevol',$formSupprListevol);
			
				
		}
		else
		{
			
			// on récupère les données du formulaire
			$data = $this->getRequest()->getPost();
			// on récupère login et mot de passe pour tester la connexion
			if(isset($data['id_vol']))
			{
				$idvol = $data['id_vol'];
			}
			else
			{
				$idvol = "";
				
			}
			if($idvol!="")
			{
				//var_dump($data);
				//die();
				//SUPPRESSION DANS LA BASE DE DONNEE

				if(count($data['id_vol'])>'1')
				{
					for($i = 0; $i < count($data['id_vol']); $i++)
					{
						$resultat = $class_Listevols->find($data['id_vol'])->current();
						$resultat->delete();
					}
				}
				else
				{
					$resultat = $class_Listevols->find($data["id_vol"])->current();
					$resultat->delete();
				}
				echo'la suppression a été effectuer';
			}
		
		}
		
	}
}