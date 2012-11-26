<?php
if(isset($_POST['maintenance'])){
	// on se connecte à notre base  pour recuperer les data
	$base = mysql_connect ('localhost', 'root', ''); 
	mysql_select_db ('inssetair_db', $base) ; 
	
	// protection contre les injection sql & php
	$matricule 	= mysql_real_escape_string(htmlspecialchars($_POST['matricule']));
	$duree 		= mysql_real_escape_string(htmlspecialchars($_POST['duree']));
	$date		= mysql_real_escape_string(htmlspecialchars($_POST['date']));
	//$jMaintenance = mysql_real_escape_string(htmlspecialchars($_POST['jMaintenance']));
	//$mMaintenance = mysql_real_escape_string(htmlspecialchars($_POST['mMaintenance']));
	//$aMaintenance = mysql_real_escape_string(htmlspecialchars($_POST['aMaintenance']));
	
	//$passe = md5($passe);
	//$timestamp = mktime(0, 0, 0, date("m"), date("d"),   date("Y"));
	//$date = date("Y-m-d", $timestamp);
	// remplace 'table_membre' par le nom de ta table
	$retour_membre = mysql_query("
	INSERT INTO maintenance (id_avion, date_prevue, duree_prevue)
	SELECT id_avion, '".$date."', '".$duree."' 
	FROM avion 
	WHERE immatriculation = \"".$matricule."\"");
	
	//mysql_free_result ($retour_membre);
	exit();
}
?>