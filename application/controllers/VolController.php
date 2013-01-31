<?php
class VolController extends Zend_Controller_Action
{
	public function indexAction()
	{
		
	}
	public function creationAction()
	{
		//Instancie le form créer
		$formVol = new Application_Form_CreationVol();
		//Instancie la classe vol
		$class_vol = new Application_Model_TVol();
		//Instancie la classe avion
		$class_avion = new Application_Model_TAvion();
		//Instancie la classe pilote
		$class_pilote = new Application_Model_TPilote();
		
		if(!$this->getRequest()->getPost())
		{
			//Envoie a la vue le form
			$this->view->assign('form_vol',$formVol);
		}
		else
		{
			// on récupère les données du formulaire
			$data = $this->getRequest()->getPost();
			
			if(isset($data['id_vol']) && isset($data['date_vol_depart']) && isset($data['date_vol_arrive'])
				 && isset($data['id_avion']) && isset($data['id_pilote']) && isset($data['id_copilote']) )
			{
				$id_vol = $data['id_vol'];
				$heure_depart = $data['date_vol_depart'];
				$heure_arrivee = $data['date_vol_arrive'];
				$id_avion = $data['id_avion'];
				$id_pilote = intval($data['id_pilote']);
				$id_copilote = intval($data['id_copilote']);
				
			}
			else
			{
				$id_vol = "";
				$heure_depart = "";
				$heure_arrivee = "";
				$id_avion = "";
				$id_pilote = "";
				$id_copilote = "";
			}
			if($id_vol != "" && $heure_depart != "" && $heure_arrivee != ""
				 && $id_avion != "" && $id_pilote != "" && $id_copilote != "")
			{
				
				
				//PREPARATION DES INFO POUR AJOUT
				//Recupération de la date de depart a decouper
				$DateHeureDepart = explode(" ",$data['date_vol_depart']);
				//Recreation de la date au format desiré
				$dateDepart = explode("/",$DateHeureDepart[0]);
				$newDateDepart = $dateDepart[2] .'-'. $dateDepart[0] .'-'. $dateDepart[1];
				$data['date_vol_depart'] = $newDateDepart . ' ' . $DateHeureDepart[1];
				//$data['date_vol_depart'] = $text[2] .'-'. $text[0] .'-'. $text[1];
				
				//Recupération de la date d'arrive a decouper
				$DateHeureArrive = explode(" ",$data['date_vol_arrive']);
				//Recreation de la date au format desiré
				$dateArrive = explode("/",$DateHeureArrive[0]);
				$newDateArrive = $dateArrive[2] .'-'. $dateArrive[0] .'-'. $dateArrive[1];
				$data['date_vol_arrive'] = $newDateArrive . ' ' . $DateHeureArrive[1];
				//$data['date_vol_depart'] = $text[2] .'-'. $text[0] .'-'. $text[1];
				//formatage heure
				$heuredepart = explode(':',$DateHeureDepart[1]);
				$heurearrive = explode(':',$DateHeureArrive[1]);
				
				
				/* CALCUL DE LA DUREE DU VOL */
				$resultat = (mktime($heurearrive[0],$heurearrive[1],"00",$dateArrive[0],$dateArrive[1],$dateArrive[2])-mktime($heuredepart[0],$heuredepart[1],"00",$dateDepart[0],$dateDepart[1],$dateDepart[2]) );
				
				$minute = $resultat / 60;
				//Utilisation de mktime
				//mktime(h,i,s,m,d,y,dst):
				//heure,minute,seconde,mois,jour,annee
				/* CALCUL DE LA DUREE DU VOL */
			
				
				//AJOUT DANS LA BD
				$ajoutVol = $class_vol->createRow($data);
				$ajoutVol->save();
				
				//Update temps de vol avion
				$update = $class_avion->find($data['id_avion'])->current();
				$update->heures_vol_totales = $update->heures_vol_totales + $minute;
				$update->save();

				//Update temps de vol pilote
				$update = $class_pilote->find($data['id_pilote'])->current();
				$update->temps_travail = $update->temps_travail + $minute;
				$update->save();
				
				//Update temps de vol co-pilote
				$update = $class_pilote->find($data['id_copilote'])->current();
				$update->temps_travail = $update->temps_travail + $minute;
				$update->save();
				
				//Envoie a la vue le form
				$this->view->assign('form_vol',$formVol);
				$Done = true;
				$this->view->Done = $Done;
			}
			else
			{
				//Envoie a la vue le form
				$this->view->assign('form_vol',$formVol);
				echo 'Champ invalide';
			}
		}
	}
}