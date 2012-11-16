package com.example.projet_airlines;

import java.util.ArrayList;
import java.util.HashMap;

import com.example.projet_airlines.R;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.Toast;

public class ChoixListeActivity extends Activity{
	
	private ListView lvChoixPerso;
	public static Utilisateur user;//permet d'envoyer l'objet dans une prochaine activit� (static)
	
	@Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_choix);
        
        //r�cup�ration de la variable
        //Bundle extra = getIntent().getExtras();
        //String Variable = extra.getClass(user)<Utilisateur>; getString("label");
        
        lvChoixPerso = (ListView) findViewById(R.id.lvChoix);
        user = getIntent().getExtras().getParcelable("utilisateur"); // recr�er lutilisateur grace au parcelable recu de l'activity pr�cedente
        
        Toast.makeText(getApplicationContext(), "Bienvenue "+user.getNom()+".", Toast.LENGTH_LONG).show();
      //Cr�ation de la ArrayList qui nous permettra de remplire la listView
        ArrayList<HashMap<String, String>> listItem = new ArrayList<HashMap<String, String>>();
 
        //On d�clare la HashMap qui contiendra les informations pour un item
        HashMap<String, String> map;
 
        //Cr�ation d'une HashMap pour ins�rer les informations du premier item de notre listView
        map = new HashMap<String, String>();
        //on ins�re un �l�ment titre que l'on r�cup�rera dans le textView titre cr�� dans le fichier affichageitem.xml
        map.put("titre", "Utilisateur");
        //on ins�re un �l�ment description que l'on r�cup�rera dans le textView description cr�� dans le fichier affichageitem.xml
        map.put("description", "Ajouter / Modifier / Supp un utilisateur");
        //on ins�re la r�f�rence � l'image (convertit en String car normalement c'est un int) que l'on r�cup�rera dans l'imageView cr�� dans le fichier affichageitem.xml
        map.put("img", String.valueOf(R.drawable.user));
        //enfin on ajoute cette hashMap dans la arrayList
        listItem.add(map);
 
        //On refait la manip plusieurs fois avec des donn�es diff�rentes pour former les items de notre ListView
 
        map = new HashMap<String, String>();
        map.put("titre", "Vol");
        map.put("description", "Liste des vols");
        map.put("img", String.valueOf(R.drawable.vol));
        listItem.add(map);
 
        map = new HashMap<String, String>();
        map.put("titre", "Maintenance");
        map.put("description", "Planification de maintenance");
        map.put("img", String.valueOf(R.drawable.maintenance));
        listItem.add(map);
 
        map = new HashMap<String, String>();
        map.put("titre", "Liste des avions");
        map.put("description", "Informations sur les appareils");
        map.put("img", String.valueOf(R.drawable.avion));
        listItem.add(map);
        
        
      //Cr�ation d'un SimpleAdapter qui se chargera de mettre les items pr�sent dans notre list (listItem) dans la vue affichageitem
        SimpleAdapter mSchedule = new SimpleAdapter (this.getBaseContext(), listItem, R.layout.affichageitem,
               new String[] {"img", "titre", "description"}, new int[] {R.id.img, R.id.titre, R.id.description});
 
        //On attribut � notre listView l'adapter que l'on vient de cr�er
        lvChoixPerso.setAdapter(mSchedule);
        
        //Enfin on met un �couteur d'�v�nement sur notre listView
        lvChoixPerso.setOnItemClickListener(new OnItemClickListener() {

			public void onItemClick(AdapterView<?> arg0, View arg1, int position, long id) {
				// TODO Auto-generated method stub
				//on r�cup�re la HashMap contenant les infos de notre item (titre, description, img)
        		HashMap<String, String> map = (HashMap<String, String>) lvChoixPerso.getItemAtPosition(position);
        		//on cr�er une boite de dialogue
        		AlertDialog.Builder adb = new AlertDialog.Builder(ChoixListeActivity.this);
        		//on attribut un titre � notre boite de dialogue
        		adb.setTitle("S�lection Item");
        		//on ins�re un message � notre boite de dialogue, et ici on affiche le titre de l'item cliqu�
        		adb.setMessage("Votre choix : "+map.get("titre"));
        		//on indique que l'on veut le bouton ok � notre boite de dialogue
        		adb.setPositiveButton("Ok", null);
        		//on affiche la boite de dialogue
        		adb.show();


        		if(map.get("titre").equals("Maintenance")){	
	        		// Lance l'activity selon le choix de l'utilisateur
	        		Intent intent = new Intent(ChoixListeActivity.this, Maintenance.class);
					intent.putExtra("utilisateur", user);// besoin de "implements Parcelable" dans la classe Utilisateur
					Toast.makeText(getApplicationContext(), "Maintenance.", Toast.LENGTH_SHORT).show();
					startActivity(intent);//lance l'activity des choix de l'utilisateur
					//finish();//ferme l'activity primaire de connexion
        		}
			}
		});
    } 
	
}
