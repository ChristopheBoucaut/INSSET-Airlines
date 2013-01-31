<?php
class Application_Form_AjoutBrevet extends Zend_Form 
{
	
	private $id;
	
	public function startform($v_id)
	{

		$this->id= $v_id;
		
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
		
		
		$class_Piote = new Application_Model_TPilote();
		$class_brevet= new Application_Model_TBrevet();
		
		
		//Paramétre le formulaire
		$this->setMethod('post');
		$this->setAction(Zend_Registry::get('baseUrl'));
		$this->setAttrib('id', 'form_ajout_avion');
		$this->addDecorators($decorators_form);

		
		$idpilote = new Zend_Form_Element_Hidden('id_pilote');
		$idpilote->setvalue($v_id);
		
		$idbrevet = new Zend_Form_Element_Select('id_brevet');
		
		
		//recupere la liste des brevet
		$classbrevet = new Application_Model_TListeBrevets();
		$listeResultat = $classbrevet->fetchAll();
		$nb=0;
		//Ajout d'un label au champ d'ajout
		foreach($listeResultat as $res)
		{
			
			$resultat = $class_brevet->find($res->id_brevet,$v_id)->current();
			if(!isset($resultat))
			{
			$nb=$nb+1;
			//$idLigne->setLabel($res->aeroport_depart);
			$idbrevet->addMultiOption($res->id_brevet, $res->code);
			}
		}
		
		
		//Champ de l'immatriculation
		$dateexp = new Zend_Form_Element_Text('date_expiration');
		$dateexp->setLabel('date expiration :');
		$dateexp->setRequired(true);
		
		
		//Instancie un element type submit
		$btSubmit = new Zend_Form_Element_Submit('Envoyer');
		
		if($nb!=0)
		{
		//Ajout des élément dans le formulaire
		$this->addElement($idbrevet);
		$this->addElement($idpilote);
		$this->addElement($dateexp);
		$this->addElement($btSubmit);
		}
		else
		{
			echo'aucun brevet a ajouter';
		}
		
		
	}
}