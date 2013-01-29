<?php

class IncidentController extends Zend_Controller_Action
{
	
	public function indexAction()
	{
	
	
	}
	
	public function ajoutAction()
	{
		//Instancie le form créer
		$formAjoutIncident = new Application_Form_AjoutIncident();
		//Instancie la classe créer
		$class_Incident = new Application_Model_TIncident();
		
		
		if(!$this->getRequest()->getPost())
		{
			//Envoie a la vue le form
			$this->view->assign('form_ajout_incident',$formAjoutIncident);
		}
		else
		{
			// on récupère les données du formulaire
			$data = $this->getRequest()->getPost();
			//$formAjoutIncident->isValid($data);
			//Verif des donnée du formulaire
			if($formAjoutIncident->isValid($data)==true)
			{ 
				// on récupère les infos du formulaire
				if(isset($data['numero_vol']) && isset($data['heure_incident']) && isset($data['note_incident']) )
				{
					$numeroVol = intval($data['numero_vol']);
					$heureIncident = $data['heure_incident'];
					$noteIncident = $data['note_incident'];
				}
				else
				{
					$numeroVol = "";
					$heureIncident = "";
					$noteIncident = "";
				}
				if($numeroVol!="" && $heureIncident!="" && $noteIncident!="")
				{
					//AJOUT DANS LA BD
					$ajoutIncident = $class_Incident->createRow($data);
					$ajoutIncident->save();
					$this->view->assign('form_ajout_incident',$formAjoutIncident);
					$Done = true;
					$this->view->Done = $Done;
				}
			}
			else
			{
				$formAjoutIncident->populate($data);
				//Envoie a la vue le form
				$this->view->assign('form_ajout_incident',$formAjoutIncident);
			}	
			
		
		}

	}
	
}
