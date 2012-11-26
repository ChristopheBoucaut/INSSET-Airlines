package com.example.projet_airlines;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import org.apache.http.message.BasicNameValuePair;

import android.util.Log;

public class RevisionMaintenance {

	String date_revision_prevue;
	int maintenanceID;
	int nbJours_prevue;
	String matricule;
	
	public RevisionMaintenance(int _maintenanceID, String _date_revision_prevue, int _nbJours_prevue, String _matricule){
		this.date_revision_prevue = _date_revision_prevue;
		this.nbJours_prevue = _nbJours_prevue;
		this.maintenanceID = _maintenanceID;
		this.matricule = _matricule;
	}
	
	public RevisionMaintenance(){
		
	}
	
	public void AjouterUneMaintenance(String dateA_M_J, String matricule, String nbJours){
		// On ajoute nos données dans une liste
        List nameValuePairs = new ArrayList();
        // On ajoute nos valeurs ici un login et le mot de passe
        nameValuePairs.add(new BasicNameValuePair("maintenance", "maintenance"));
        nameValuePairs.add(new BasicNameValuePair("date", dateA_M_J));
        nameValuePairs.add(new BasicNameValuePair("duree", nbJours));
        nameValuePairs.add(new BasicNameValuePair("matricule", matricule));
        //Création d'un objet pour faire des demande HTTP
        ToolsHTTPandJASON Reponse = new ToolsHTTPandJASON();
        //Stock la valeur en mémoire pour eviter de faire l'appel 2x (car je fait un affichage dans le log console)
        String Requete = Reponse.RecuperationRequeteHTTP("http://10.0.2.2/script_ajouter_maintenance.php", nameValuePairs, false);
        Log.i("INFO Ajout M : ", Requete);
	}
}
