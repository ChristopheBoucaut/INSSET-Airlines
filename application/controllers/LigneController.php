<?php

class LigneController extends Zend_Controller_Action
{
	public function ajoutAction()
	{
		//Instancie le form créer
		$formAjoutLigne = new Application_Form_AjoutLigne();
		//Instancie la classe créer
		$class_Ligne = new Application_Model_TLigne();
		
		
		if(!$this->getRequest()->getPost())
		{
			//Envoie a la vue le form
			$this->view->assign('form_ajout_ligne',$formAjoutLigne);
		}
		else
		{
			// on récupère les données du formulaire
			$data = $this->getRequest()->getPost();
			 
			// on récupère login et mot de passe pour tester la connexion
			if(isset($data['nom_ligne']) && isset($data['aeroport_depart']) && isset($data['aeroport_arrive']) ){
				$nomligne = $data['nom_ligne'];
				$aeroportDepart = intval($data['aeroport_depart']);
				$aeroportArrive = intval($data['aeroport_arrive']);
			}
			else
			{
				$nomligne = "";
				$aeroportDepart = "";
				$aeroportArrive = "";
			}
			if($nomligne!="" && $aeroportDepart!="" && $aeroportArrive!="")
			{
				//AJOUT DANS LA BD
				$ajoutLigne = $class_Ligne->createRow($data);
				$ajoutLigne->save();
				$this->view->assign('form_ajout_ligne',$formAjoutLigne);
				$Done = true;
				$this->view->Done = $Done;
			}
			
		
		
		}

	}
}