<?php
class BrevetController extends Zend_Controller_Action
{
	public function indexAction()
	{
		
		$class_Piote = new Application_Model_TPilote();
		$id= $id = $this->_getParam('id');
		if(isset($id))
		{
			$resultat = $class_Piote->find($id)->current();
			$this->view->assign('pilote',$resultat);	
		}
		else
		{
			//Instancie la classe créer
			$class_Piote = new Application_Model_TPilote();
			$listeResultat = $class_Piote->fetchAll();
			
			//envoi du resultat a la vue
			$this->view->assign('listePilote',$listeResultat);
		}
	}
	public function ajoutAction()
	{
		$id= $id = $this->_getParam('id');
		$formAjoutbrevet = new Application_Form_AjoutBrevet();
		
		BrevetController::verif();
		
		if(isset($id))
		{
						//Instancie le form créer
			
			$formAjoutbrevet -> startform($id);
			$this->view->assign('form_ajoutbrevet',$formAjoutbrevet);
		}
		else
		{
			if($this->getRequest()->getPost())
			{
			
				$classbrevet = new Application_Model_TBrevet();
			
				// on récupère les données du formulaire
				$data = $this->getRequest()->getPost();
				
				//$formAjoutLigne->isValid($data);
				//Verif des donnée du formulaire
				
				$datexpl = explode("/",$data['date_expiration']);
				$data['date_expiration'] = $datexpl[2] .'-'. $datexpl[0] .'-'. $datexpl[1];
				
				if($formAjoutbrevet->isValid($data)==true)
				{
					$ajoutLigne = $classbrevet->createRow($data);
					$ajoutLigne->save();
					echo"Enregistrement effectuer";
				}
				else
				{
					echo'ereur';
				}
			}
		}
	}
	
	public static function verif()
	{
		
		//Instancie le form créer
		$class_brevet = new Application_Model_TBrevet();
				//Instancie la classe créer
		$liste = $class_brevet->fetchall();
		
		foreach($liste as $un)
		{
			
			$dateexp = new Zend_Date();
			$dateexp = $un->date_expiration;
			$dateact = new Zend_Date();
			$dateact = Zend_Date::now();
			$dateact = $dateact->toString('yyyy-MM-dd');//je passe le forma
			if($dateexp<$dateact)
			{
				$resultat = $class_brevet->find($un->id_brevet,$un->id_pilote)->current();
				$resultat->delete();
			}
		}
	}
}