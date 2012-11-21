package com.example.projet_airlines;

import java.util.Date;

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
	
	
}
