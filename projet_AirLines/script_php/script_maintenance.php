<?php
//if(isset($_POST['passe']) && isset($_POST['login']))
//{
	// on se connecte à notre base  pour recuperer les data
	$base = mysql_connect ('localhost', 'root', ''); 
	mysql_select_db ('inssetair_db', $base) ; 
	
	// protection contre les injection sql & php
	//$passe = mysql_real_escape_string(htmlspecialchars($_POST['passe']));
	//$login = mysql_real_escape_string(htmlspecialchars($_POST['login']));

	//$passe = md5($passe);
	$Dans4semaines = mktime(0, 0, 0, date("m"), date("d")+28,   date("Y"));
	$dateS4 = date("Y-m-d", $Dans4semaines);
	// remplace 'table_membre' par le nom de ta table
	$retour_membre = mysql_query(
	"SELECT M.id_maintenance, M.date_prevue, M.duree_prevue, A.immatriculation
	FROM maintenance AS M
	INNER JOIN avion AS A ON A.id_avion = M.id_avion
	WHERE M.date_prevue < \"".$dateS4."\" AND M.date_effective <> NULL
	OR M.duree_effective IS NULL
	ORDER BY M.date_prevue ASC
	LIMIT 0 , 30");
	
	while($donnees = mysql_fetch_assoc($retour_membre))
	{	
		$output[]=$donnees;
	}
	mysql_free_result ($retour_membre);
	
	if(isset($output) && $output != NULL){
		print(json_encode($output));
	}
	else{
		$t[] = array('id_maintenance' => "0");
		print(json_encode($t));
	}
	exit();
//}

?>