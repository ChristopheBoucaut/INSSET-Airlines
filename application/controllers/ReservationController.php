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
			
			
			// requete pour la date depart et arrivee du vol
			$reservationInstance = new Application_Model_TReservation;
			$requete =  $reservationInstance->select()->setIntegrityCheck(false)
					->from((array('r' => 'reservation', 'v' => 'vol')),array('r.nb_places_reservees', 'v.date_vol_depart',  'v.date_vol_arrive', 'v.id_vol'))
					->join(array('v' => 'vol'),'v.numero_vol = r.numero_vol', '')
					->where('r.id_enregistrement = ?', $id_reservation);
	
			
			$listeResultat = $reservationInstance->fetchAll($requete);
			$array_reservation = $listeResultat->toArray();
			//var_dump($listeResultat);
			$date_vol_depart = $array_reservation[0]['date_vol_depart'];
			$date_vol_arrive = $array_reservation[0]['date_vol_arrive'];
			$nb_places_reservees = $array_reservation[0]['nb_places_reservees'];
			$id_vol = $array_reservation[0]['id_vol'];
			
			//echo $date_vol_depart;
			//echo $date_vol_arrive;
			//echo $id_reservation;
			
			// requete qui recupère l'id_ligne du vol
			$listevolInstance = new Application_Model_TListeVols;
			$requete2 =  $listevolInstance->select()->setIntegrityCheck(false)
			->from((array('l' => 'liste_vols')),array('l.id_ligne'))
			->where('l.id_vol = ?', $id_vol);
			
			$Resultat = $listevolInstance->fetchAll($requete2);
			$array_vol = $Resultat->toArray();
			//var_dump($Resultat);
			$id_ligne = $array_vol[0]['id_ligne'];
			
			
			$class_Ligne = new Application_Model_TLigne();
			$class_Aeroport = new Application_Model_TAeroport;
	
			//Requete pour recupérer l'aeroport de depart et d'arrive
			$requete3 = $class_Ligne->select()->setIntegrityCheck(false)
			->from((array('d' => 'aeroport')),array('d.nom_aeroport as depart','a.nom_aeroport as arrive'))
			->join(array('l' => 'ligne'),'l.aeroport_depart = d.id_aeroport', '')
			->join(array('a' => 'aeroport'),'l.aeroport_arrive = a.id_aeroport', '')
			->where('l.id_ligne = ?', $id_ligne);
			
			//echo $requete3;
			
			
			$Resultat3 = $class_Ligne->fetchAll($requete3);
			$array_aeroport = $Resultat3->toArray();
			//var_dump($listeResultat);
			$aeroport_depart = $array_aeroport[0]['depart'];
			$aeroport_arrive = $array_aeroport[0]['arrive'];
	
			$class_Client = new Application_Model_TClient;
			
			//Requete pour recupérer l'aeroport de depart et d'arrive
			$requete4 = $class_Client->select()->setIntegrityCheck(false)
			->from((array('c' => 'client')),array('c.nom_client', 'c.prenom_client', 'c.adresse_facturation', 'c.adresse_livraison'))
			->join(array('r' => 'reservation'),'r.id_client = c.id_client', '')
			->where('r.id_enregistrement = ?', $id_reservation);
			
			$Resultat4 = $class_Ligne->fetchAll($requete4);
			$array_client = $Resultat4->toArray();
			//var_dump($listeResultat);
			$nom_client = $array_client[0]['nom_client'];
			$prenom_client = $array_client[0]['prenom_client'];
			$adresse_facturation = $array_client[0]['adresse_facturation'];
			$adresse_livraison = $array_client[0]['adresse_livraison'];
			
			$tableau['date_vol_depart'] = $date_vol_depart;
			$tableau['date_vol_arrive'] = $date_vol_arrive;
			$tableau['nb_places_reservees'] = $nb_places_reservees;
			$tableau['aeroport_depart'] = $aeroport_depart;
			$tableau['aeroport_arrive'] = $aeroport_arrive;
			$tableau['nom_client'] = $nom_client;
			$tableau['prenom_client'] = $prenom_client;
			$tableau['adresse_facturation'] = $adresse_facturation;
			$tableau['adresse_livraison'] = $adresse_livraison;

		if(!$this->getRequest()->getPost())
		{	
			
			$this->view->assign($tableau);
			
			
			//Instancie le form créer
			$formAfficherReservation = new Application_Form_AfficherReservation();
			$this->view->assign('form_afficher_reservation', $formAfficherReservation);
			
		
		}
		else 
		{
			$class_reservation = new Application_Model_TReservation;
			$update = $class_reservation->find($id_reservation)->current();
			$update->option_reservation = 1;
			$update->save();

			$Done = true;
			$this->view->Done = $Done;
			
		}
		
		
	}
}