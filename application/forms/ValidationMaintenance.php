<?php
class Application_Form_ValidationMaintenance extends Zend_Form 
{
	
	private $id;  

	public function startform($v_id)
	{
		//Recupération du paramétre
		$this->id = $v_id; 	
		// Décorateur pour les inputs de login et mdp
		$decorators_input = array(
				array('ViewHelper'),
				array('Errors'),
				array('Label'
				),
				array('HtmlTag')
		);
		
		// Décorateur pour le formulaire en général
		$decorators_form = array(
				'FormElements',
				'Form'
		);
		
		//Paramétre le formulaire
		$this->setMethod('post');
		$this->setAction(Zend_Registry::get('baseUrl'));
		$this->setAttrib('id', 'form_validation');
		$this->addDecorators($decorators_form);
		
		//Instancie la classe maintenance
		$class_maintenance = new Application_Model_TMaintenance();
		//Requete avec jointure sur la maintenance compléte
		$requete = $class_maintenance->select()->setIntegrityCheck(false)
							->from((array('maintenance','avion')),array('maintenance.id_maintenance',
																			'maintenance.date_prevue',
																			'maintenance.duree_prevue',
																			'maintenance.date_effective',
																			'maintenance.duree_effective',
																			'avion.immatriculation'))
							->join('avion', 'avion.id_avion = maintenance.id_avion', 'id_avion');
		$listeResultat = $class_maintenance->fetchAll($requete);
		//Stockage du paramétre dans une variable
		$id = $this->id;
		//S'il n'y a aucun paramétre en url on affiche les maintenance
		if(empty($id))
		{
			foreach($listeResultat as $res)
			{
				if($res->date_effective == NULL)
				{
					$baseUrl = new Zend_View_Helper_BaseUrl();
                    echo'<a href="'.$baseUrl->baseUrl('maintenance/validation').'?id='. $res->id_maintenance.'">'.$res->immatriculation . ' ' .$res->date_prevue . '</a><br>';
				}
			}	
		}
		else
		{
			//Sinon on affiche la maintenance selectionné
			$requeteID = $class_maintenance->select()->setIntegrityCheck(false)
						->from((array('maintenance','avion')),array('maintenance.id_maintenance',
																	'maintenance.date_prevue',
																	'maintenance.duree_prevue',
																	'maintenance.date_effective',
																	'maintenance.duree_effective',
																'avion.immatriculation'))
						->join('avion', 'avion.id_avion = maintenance.id_avion', 'id_avion')
						->where('id_maintenance = ?' , $id);
			$resultatID = $class_maintenance->fetchAll($requeteID);
			//Affichage des deux champs désire avec les autres champ caché (hidden)
			foreach($resultatID as $resImma)
			{
				$idmaintenance = new Zend_Form_Element_Hidden('id_maintenance');
				$idmaintenance->setValue($id);
				$dateprevue = new Zend_Form_Element_Hidden('date_prevue');
				$dateprevue->setValue($resImma->date_prevue);
				$dureeprevue = new Zend_Form_Element_Hidden('duree_prevue');
				$dureeprevue->setValue($resImma->duree_prevue);
				$idavion = new Zend_Form_Element_Hidden('id_avion');
				$idavion->setValue($resImma->id_avion);
				$dateeffective = new Zend_Form_Element_Text('date_effective');
				$dureeeffective = new Zend_Form_Element_Text('duree_effective');
				$dateeffective->setLabel('Date effective :');
				$dureeeffective->setLabel('Durée effective :');
				$this->addElement($idmaintenance);
				$this->addElement($dateprevue);
				$this->addElement($dureeprevue);
				$this->addElement($dateeffective);
				$this->addElement($dureeeffective);
				$this->addElement($idavion);
				//Instancie un element type submit
				$btSubmit = new Zend_Form_Element_Submit('Envoyer');
				$this->addElement($btSubmit);
			}
		}
	}

}