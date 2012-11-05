<?php

if(isset($_GET['mdp'])){
	echo "Le mot de passe : ".$_GET['mdp']."<br/>donne en MD5 : ".md5($_GET['mdp']);
}else{
	$_GET['mdp']="";
}
echo "<br/><form action='#' method='GET'>Mot de passe : <input type='text' name='mdp' value='".$_GET['mdp']."'/></form>";
?>