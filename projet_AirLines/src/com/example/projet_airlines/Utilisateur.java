package com.example.projet_airlines;

import android.os.Parcel;
import android.os.Parcelable;

public class Utilisateur implements Parcelable{

	private static int idUser, idSection;
	private static String login, mdp;
	
	public Utilisateur(int userID, int sectionID, String pseudo, String pwd)
	{
		super();
		this.idUser = userID;
		this.idSection = sectionID;
		this.login = pseudo;
		this.mdp = pwd;
	}
	
	public Utilisateur(Parcel in) {
		this.idUser = in.readInt();
		this.idSection = in.readInt();
		this.login = in.readString();
		this.mdp = in.readString();
	}

	public String getNom(){
		return this.login;
	}
	//@Override
	public int describeContents()
	{
		return 0;
	}

	//@Override
	public void writeToParcel(Parcel dest, int flags)
	{
		dest.writeInt(idUser);
		dest.writeInt(idSection);
		dest.writeString(login);
		dest.writeString(mdp);
	}
	
	public Utilisateur(String Login, String pwd, int userID) {
		// CONNEXION A LA BDD ET RECUPERATION DES DONNEES DE L'UTILISATEUR
		
		this.idUser = userID;
		//this.idSection = ;
		this.login = Login;
		this.mdp = pwd;
		
	}
	
	public static final Parcelable.Creator<Utilisateur> CREATOR = new Parcelable.Creator<Utilisateur>()
	{
		//@Override
		public Utilisateur createFromParcel(Parcel source)
		{
			return new Utilisateur(source);
		}

		//@Override
		public Utilisateur[] newArray(int size)
		{
			return new Utilisateur[size];
		}
	};

	public static Parcelable.Creator<Utilisateur> getCreator()
	{
		return CREATOR;
	}
}