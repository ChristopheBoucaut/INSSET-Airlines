<?php
//if(isset($_POST['android'])){
//	echo "une requête android est demande!";
//}
//echo("id: ".$_POST['id']." data: ".$_POST['message']);
	
// Le script s'éxécute complement avant de retourner la réponse... Logique me diriez vous !! Certe !
// Le Message vaudra : "une requête android est demande!id: ".$_POST['id']." data: ".$_POST['message']"



if(isset($_POST['passe']) && isset($_POST['login']))
{
	// on se connecte à notre base  pour recuperer les data
	$base = mysql_connect ('localhost', 'root', ''); 
	mysql_select_db ('inssetair_db', $base) ; 
	
	// protection contre les injection sql & php
	$passe = mysql_real_escape_string(htmlspecialchars($_POST['passe']));
	$login = mysql_real_escape_string(htmlspecialchars($_POST['login']));

	//$passe = md5($passe);
	
	// remplace 'table_membre' par le nom de ta table
	$retour_membre = mysql_query("SELECT * FROM utilisateur");

	while($donnees = mysql_fetch_assoc($retour_membre))
	{	
		// verifie si le login et mot de passe sont identique à celui de la BDD
		if( strtolower($donnees['login']) == strtolower($login) AND $donnees['mdp'] == $passe)
		{
			// l'utilisateur est enregistrer
			$output[]=$donnees;
			print(json_encode($output)); 
			mysql_free_result ($retour_membre);
			exit();
		}
	}
	mysql_free_result ($retour_membre);
	$t[] = array('id_utilisateur' => "0");
	print(json_encode($t));
	exit();
}




?>

