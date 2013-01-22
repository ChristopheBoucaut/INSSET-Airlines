<?php
class MaintenanceController extends Zend_Controller_Action
{
	public function indexAction()
	{
		
	}
	public function planifAction()
	{
		//Instancie le form créer
		$formMaintenancePlanif = new Application_Form_MaintenancePlanif();
		//Instancie la classe créer
		$class_maintenance = new Application_Model_TMaintenance();
		
		if(!$this->getRequest()->getPost())
		{
			//Envoie a la vue le form
			$this->view->assign('form_maintenance_planif',$formMaintenancePlanif);
		}
		else
		{
			// on récupère les données du formulaire
			$data = $this->getRequest()->getPost();
			$dataRefac = $this->getRequest()->getPost();
			//$formAjoutLigne->isValid($data);
			//Verif des donnée du formulaire
			if($formMaintenancePlanif->isValid($data)==true)
			{ 

				//On récupère les infos du formulaire
				if(isset($data['datepicker'])  
					&& isset($data['duree_prevue']) 
					&& isset($data['id_avion']) )
				{
					//Place les données dans un nouveau tableau avec les nouvels valeurs
					$dataRefac['date_prevue'] = $data['datepicker'];
					$dataRefac['duree_prevue'] = $data['duree_prevue'];
					$dataRefac['date_effective'] = null;
					$dataRefac['duree_effective'] = null;
					$dataRefac['id_avion'] = $data['id_avion'];
					//Recupération de la date decouper
					$text = explode("/",$dataRefac['date_prevue']);
					//Recreation de la date au format desiré
					$dataRefac['date_prevue'] = $text[2] . $text[0] . $text[1];
				}
				else
				{
					$dataRefac['date_prevue'] = "";
					$dataRefac['duree_prevue'] = "";
					$dataRefac['id_avion'] = "";
				}
				if($dataRefac['date_prevue']!="" && $dataRefac['duree_prevue']!="" && $dataRefac['id_avion']!="")
				{
					
					//AJOUT DANS LA BD
					$ajoutMaintenance = $class_maintenance->createRow($dataRefac);
					$ajoutMaintenance->save();
					//Envoie a la vue le form
					$this->view->assign('form_maintenance_planif',$formMaintenancePlanif);
					$Done = true;
					$this->view->Done = $Done;
				}
			}
			else
			{
				$formMaintenancePlanif->populate($dataRefac);
				//Envoie a la vue le form
				$this->view->assign('form_maintenance_planif',$formMaintenancePlanif);
			}	
		}
	}
	public function supprplanifAction()
	{
		//Instancie le form créer
		$formMaintenanceSupprPlanif = new Application_Form_MaintenanceSupprPlanif();
		//Instancie la classe créer
		$class_maintenance = new Application_Model_TMaintenance();
		
		// on récupère les données du formulaire
		$data = $this->getRequest()->getPost();
		
		if(!$this->getRequest()->getPost())
		{
			//Envoie a la vue le form
			$this->view->assign('form_maintenance_suppr_planif',$formMaintenanceSupprPlanif);
		}
		else
		{
			//var_dump( $data['id_maintenance'] );
			//die();
			// on récupère login et mot de passe pour tester la connexion
			if(isset($data['id_maintenance']))
			{
				$idmaintenance = $data['id_maintenance'];
			}
			else
			{
				$idmaintenance = "";
			}
			if($idmaintenance!="")
			{
				//SUPPRESSION DANS LA BASE DE DONNEE
				for($i = 0; $i <= count($data); $i++)
				{
					$resultat = $class_maintenance->find($data['id_maintenance'][$i])->current();
					$resultat->delete();
				}
				//Envoie a la vue le form
				$this->view->assign('form_maintenance_suppr_planif',$formMaintenanceSupprPlanif);
				$Done = true;
				$this->view->Done = $Done;
			}
		}
		
	}
	public function validationAction()
	{
		//Instancie le form créer
		$formValidation = new Application_Form_ValidationMaintenance();
		//Instancie la classe créer
		$class_maintenance = new Application_Model_TMaintenance();
		//Envoie a la vue le form
		$this->view->assign('form_maintenance_validation',$formValidation);
		// on récupère les données du formulaire
		$data = $this->getRequest()->getPost();
		
		if(!$this->getRequest()->getPost())
		{
			//Envoie a la vue le form
			$this->view->assign('form_maintenance_validation',$formValidation);
		}
		else
		{
			// on récupère login et mot de passe pour tester la connexion

				//SUPPRESSION DANS LA BASE DE DONNEE
				for($i = 1; $i <= count($data); $i++)
				{
					$resultat = $class_maintenance->find($data[$i])->current();
					$resultat->date_effective = $data[$i] ;
					$resultat->duree_effective = $data[$i+1];
					$resultat->save();
				}
				//Envoie a la vue le form
				$this->view->assign('form_maintenance_suppr_planif',$formMaintenanceSupprPlanif);
				$Done = true;
				$this->view->Done = $Done;
			
		}
	}
}