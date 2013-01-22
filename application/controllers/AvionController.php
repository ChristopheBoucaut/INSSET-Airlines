<?php
class AvionController extends Zend_Controller_Action
{
	public function indexAction()
	{
		
		
	}
	public function ajoutAction()
	{
		//Instancie le form créer
		$formAjoutAvion = new Application_Form_AjoutAvion();
		//Instancie le form créer
		$class_avion = new Application_Model_TAvion();
		
		if(!$this->getRequest()->getPost())
		{
			//Envoie a la vue le form
			$this->view->assign('form_ajout_avion',$formAjoutAvion);
		}
		else
		{
			// on récupère les données du formulaire
			$data = $this->getRequest()->getPost();
			//$formAjoutTypeAvion->isValid($data);
			//Verif des donnée du formulaire
			if($formAjoutAvion->isValid($data)==true)
			{ 
				// on récupère les infos du formulaire
				if(isset($data['immatriculation']) 
					&& isset($data['id_type']))
				{
					$immatriculation = $data['immatriculation'];
					$heurevoltotale = "0";
					$heureGmaintenance = "0";
					$idType = $data['id_type'];
				}
				else
				{
					$immatriculation = "";
					$heurevoltotale = "";
					$heureGmaintenance = "";
					$idType = "";
				}
				if($immatriculation!="" && $idType!="")
				{
					//AJOUT DANS LA BD
					$ajoutAvion = $class_avion->createRow($data);
					$ajoutAvion->save();
					//Envoie a la vue le form
					$this->view->assign('form_ajout_avion',$formAjoutAvion);
					$Done = true;
					$this->view->Done = $Done;
				}
			}
			else
			{
				$formAjoutAvion->populate($data);
				//Envoie a la vue le form
				$this->view->assign('form_ajout_avion',$formAjoutAvion);
				
			}
		}
	}
	public function typeAction()
	{
		//Instancie le form créer
		$formAjoutTypeAvion = new Application_Form_AjoutTypeAvion();
		//Instancie le model créer
		$class_listebrevet = new Application_Model_TListeBrevetS();
		//Instancie le model créer
		$class_typeavion = new Application_Model_TTypeAvion();
		
		if(!$this->getRequest()->getPost())
		{
			//Envoie a la vue le form
			$this->view->assign('form_ajout_type_avion',$formAjoutTypeAvion);
		}
		else
		{
			// on récupère les données du formulaire
			$data = $this->getRequest()->getPost();
			//$formAjoutTypeAvion->isValid($data);
			//Verif des donnée du formulaire
			if($formAjoutTypeAvion->isValid($data)==true)
			{ 
				// on récupère les infos du formulaire
				if(isset($data['id_brevet']) 
					&& isset($data['nb_place']) 
					&& isset($data['rayon_action']) 
					&& isset($data['atterrissage_longueur'])
					&& isset($data['decollage_longueur']) 
					)
				{
					$idBrevet = $data['id_brevet'];
					$nbPlace = intval($data['nb_place']);
					$rayonAction = intval($data['rayon_action']);
					$attLong = intval($data['atterrissage_longueur']);
					$decoLong = intval($data['decollage_longueur']);
				}
				else
				{
					$idBrevet = "";
					$nbPlace = "";
					$rayonAction = "";
					$attLong = "";
					$decoLong = "";
				}
				if($idBrevet!="" && $nbPlace!="" && $rayonAction!="" && $attLong!="" && $decoLong!="")
				{
					//AJOUT DANS LA BD
					$ajoutType = $class_typeavion->createRow($data);
					$ajoutType->save();
					//Envoie a la vue le form
					$this->view->assign('form_ajout_type_avion',$formAjoutTypeAvion);
					$Done = true;
					$this->view->Done = $Done;
				}
			}
			else
			{
				$formAjoutTypeAvion->populate($data);
				//Envoie a la vue le form
				$this->view->assign('form_ajout_type_avion',$formAjoutTypeAvion);
				
			}
		}
	}
}