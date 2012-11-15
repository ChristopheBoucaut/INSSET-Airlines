package com.example.projet_airlines;

public class Avion {

	private String  typeDerniereRevision, immatriculation, typeAvion;
	
	public Avion(String matricul, String type) {
		
	}

	public String getTypeAvion(){
		return "Type...";
	}
	
	public int getHeuresPrecedenteRevision(){
		return 50000; //heures de vol ? jours ? heures passées ? ...
	}
	
	public String getTypePrecedenteRevision(){
		return "Grande/Petite";
	}
	
	public int getNbPlace(){
		return 200;
	}
	
	public String getImmatriculation(){
		return "AV-500-FR";
	}
	
	
}
