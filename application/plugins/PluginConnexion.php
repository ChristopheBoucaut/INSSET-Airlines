<?php

class Application_Plugin_PluginConnexion extends Zend_Controller_Plugin_Abstract {
	
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$auth = Zend_Auth::getInstance();
		
		// Si on est pas connecté et qu'on est pas sur le formulaire de connexion
		if(!$auth->hasIdentity()
				&& $this->_request->getControllerName() != 'index'
				&& $this->_request->getActionName() != 'index')
		{
			// On récupère l'action et controller désiré
			$need_action = $this->_request->getActionName();
			$need_controller = $this->_request->getControllerName();
			
			// On prépare l'url de redirection 
			$url = '/index/index?need_action='.$need_action.'&need_controller='.$need_controller.'&need_connexion=1';
			
			// On instancie une aide redirector et on effectue la redirection
			$redirector = new Zend_Controller_Action_Helper_Redirector;
			$redirector->gotoUrlAndExit($url, array('exit' => true));
			
		}
	}
}

?>