<?php
if(isset($_POST['matricule'])){
	// on se connecte à notre base  pour recuperer les data
	$base = mysql_connect ('localhost', 'root', ''); 
	mysql_select_db ('inssetair_db', $base) ; 
	
	// protection contre les injection sql & php
	$matricule = mysql_real_escape_string(htmlspecialchars($_POST['matricule']));
	$duree = mysql_real_escape_string(htmlspecialchars($_POST['duree']));

	//$passe = md5($passe);
	//$Dans4semaines = mktime(0, 0, 0, date("m"), date("d")+28,   date("Y"));
	//$dateS4 = date("Y-m-d", $Dans4semaines);
	// remplace 'table_membre' par le nom de ta table
	$retour_membre = mysql_query("
	UPDATE maintenance M
	INNER JOIN avion A ON M.id_avion = A.id_avion
	SET date_effective = \"".date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")))."\",
	duree_effective = \"".$duree."\"
	WHERE A.immatriculation = \"".$matricule."\"");
	
	mysql_free_result ($retour_membre);
	exit();
	
}
?>