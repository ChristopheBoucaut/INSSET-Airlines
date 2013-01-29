<?php

class ReservationController extends Zend_Controller_Action
{
	public function indexAction()
	{
		
		
	}
	public function ajoutAction()
	{
		//Instancie le form créer
		$formAjoutReservation = new Application_Form_AjoutReservation(array('url'=>$this->view->baseUrl('reservation/ajout')));
		//Instancie la classe créer
		$class_Reservation = new Application_Model_TReservation();
		
		
		if(!$this->getRequest()->getPost())
		{
			//Envoie a la vue le form
			$this->view->assign('form_ajout_reservation',$formAjoutReservation);
		}
		else
		{
			// on récupère les données du formulaire
			$data = $this->getRequest()->getPost();
			//$formAjoutLigne->isValid($data);
			//Verif des donnée du formulaire
			
			 
			if($formAjoutReservation->isValid($data)==true)
			{ 
				// on récupère les infos du formulaire
				if(isset($data['numero_vol']) && isset($data['nb_places_reservees']) && isset($data['email_client']) )
				{
					$numero_vol = $data['numero_vol'];
					$nb_places_reservees = $data['nb_places_reservees'];
					$mail_client = $data['email_client'];
					$option_reservation = 0;
				}
				else
				{
					$numero_vol = "";
					$nb_places_reservees = "";
					$mail_client = "";
					$option_reservation = 0;
				}
				
				if ($mail_client!=""){
					
					$ligneInstance = new Application_Model_TClient;
					$requete =  $ligneInstance->select()->from(array('c' => 'client'), array("c.id_client"))->where('email_client = ?', $mail_client);
					
					$idClient = $ligneInstance->fetchAll($requete);
					$array_client = $idClient->toArray();
					$data['email_client'] = $array_client[0]['id_client'];
					$data['id_client'] = $data['email_client'];
					$id_client = $data['id_client'];
					
					
				}
				
				$data['option'] = $option_reservation;
				$data['heureOption'] = $option_reservation;
				
				if($numero_vol!="" && $nb_places_reservees!="" && $id_client!="")
				{
					$data['option'] = $option_reservation;
					
					//AJOUT DANS LA BD
					$ajoutReservation = $class_Reservation->createRow($data);
					$id = $ajoutReservation->save();
					$this->_helper->getHelper('Redirector')->gotoSimple(afficher, reservation, null, array('id_reservation'=>$id));
					
					$this->view->assign('form_ajout_reservation',$formAjoutReservation);
					$Done = true;
					$this->view->Done = $Done;
				}
			}
			else
			{
				$formAjoutReservation->populate($data);
				//Envoie a la vue le form
				$this->view->assign('form_ajout_reservation',$formAjoutReservation);
			}	
		
		}

	}
	
	
	public function afficherAction(){
		$id_reservation = $this->getRequest()->getParam('id_reservation');
		$this->view->assign('form_afficher_reservation');
		
		echo $id_reservation;
		
	}
	
}