package com.example.projet_airlines;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.StringTokenizer;

import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONObject;

import android.os.Bundle;
import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.View;
import android.widget.AdapterView;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.Toast;
import android.widget.AdapterView.OnItemClickListener;

public class ListeMaintenance extends Activity {

	private final boolean PARSE_JSON = false;
	private ListView lvChoixPerso;
	LayoutInflater factory;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_liste_maintenance);
		factory = LayoutInflater.from(this);
		
		lvChoixPerso = (ListView)findViewById(R.id.lvMaintenance);
		RevisionMaintenance[] tRevision;
		
		try {
            // On ajoute nos données dans une liste
            List nameValuePairs = new ArrayList();
            // On ajoute nos valeurs ici un login et le mot de passe
            //nameValuePairs.add(new BasicNameValuePair("android", "android_valeur"));
            //Création d'un objet pour faire des demande HTTP
            ToolsHTTPandJASON Reponse = new ToolsHTTPandJASON();
            //Stock la valeur en mémoire pour eviter de faire l'appel 2x (car je fait un affichage dans le log console)
            String Requete = Reponse.RecuperationRequeteHTTP("http://10.0.2.2/script_maintenance.php", nameValuePairs, PARSE_JSON);
            Log.i("INFO : ", Requete);
            JSONArray jsA = new JSONArray(Requete);  
            JSONObject js;
            int i = 0;
            tRevision = new RevisionMaintenance[jsA.length()];
            
            
            //Création de la ArrayList qui nous permettra de remplire la listView
            ArrayList<HashMap<String, String>> listItem = new ArrayList<HashMap<String, String>>();
     
            //On déclare la HashMap qui contiendra les informations pour un item
            HashMap<String, String> map;
            
            while(jsA.length() > i){
            	//Log.i("INFO : ", "Boucle Ajout liste maintenance");
            	js = jsA.getJSONObject(i);
            	tRevision[i] = new RevisionMaintenance(js.getInt("id_maintenance"), js.getString("date_prevue"), js.getInt("duree_prevue"), js.getString("immatriculation"));
            	
            	//Création d'une HashMap pour insérer les informations du premier item de notre listView
                map = new HashMap<String, String>();
                map.put("date", js.getString("date_prevue")+" : " + js.getInt("duree_prevue") + " jours");
                map.put("matricule", js.getString("immatriculation"));
                map.put("img", String.valueOf(R.drawable.vol));
                listItem.add(map);
                
            	i++;
            }
            
            
          //Création d'un SimpleAdapter qui se chargera de mettre les items présent dans notre list (listItem) dans la vue affichageitem
            SimpleAdapter mSchedule = new SimpleAdapter (this.getBaseContext(), listItem, R.layout.affichageitem,
                   new String[] {"img", "matricule", "date"}, new int[] {R.id.img, R.id.titre, R.id.description});
            
          //On attribut à notre listView l'adapter que l'on vient de créer
            lvChoixPerso.setAdapter(mSchedule);
            
        } catch (Exception e) {
        	Log.i("Erreur IO : ", e.getMessage());
        }
		
        
        //Normalement c'est une boucle on récupere les données depuis la base de données mais la c'est pour tester rapidement
        
        //map = new HashMap<String, String>();
        //map.put("date", "21-12-2012 : 2 Jours");
        //map.put("matricule", "AV-500-FR");
        //map.put("img", String.valueOf(R.drawable.vol));
        //listItem.add(map);
        
 
        
      //Enfin on met un écouteur d'évènement sur notre listView
        lvChoixPerso.setOnItemClickListener(new OnItemClickListener() {

			public void onItemClick(AdapterView<?> arg0, View arg1, int position, long id) {
				//On instancie notre layout en tant que View
		        final View alertDialogView = factory.inflate(R.layout.alerte_validation_maintenance, null);
				
				//on récupère la HashMap contenant les infos de notre item (titre, description, img)
        		HashMap<String, String> map = (HashMap<String, String>) lvChoixPerso.getItemAtPosition(position);
        		//on créer une boite de dialogue
        		AlertDialog.Builder adb = new AlertDialog.Builder(ListeMaintenance.this);
        		//On affecte la vue personnalisé que l'on a crée à notre AlertDialog
                adb.setView(alertDialogView);
        		//on attribut un titre à notre boite de dialogue
        		adb.setTitle("Enregistrer la fin de la révision :");

        		adb.setMessage("Durée de la maintenance pour : "+map.get("matricule"));
        		final String matricule_avion = map.get("matricule");
        		final String date_rev = recupereSeulementDate(map.get("date"));
        		
        		//On crée un bouton "Annuler" à notre AlertDialog et on lui affecte un évènement
                adb.setNegativeButton("Annuler", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                    	Toast.makeText(getApplicationContext(), "Aucune modification effectué !!", Toast.LENGTH_SHORT).show();
                  } });
                
                //on indique que l'on veut le bouton ok à notre boite de dialogue
        		adb.setPositiveButton("Ok", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                    	//Lorsque l'on cliquera sur le bouton "OK", on récupère l'EditText correspondant à notre vue personnalisée (cad à alertDialogView)
                    	EditText et = (EditText)alertDialogView.findViewById(R.id.EditTextAlertMaintenance);

                    	//Toast.makeText(getApplicationContext(), "Execution UPDATE sur la base ", Toast.LENGTH_SHORT).show();
                    	maintenanceTerminer(matricule_avion, et.getText().toString(), date_rev);
                    	//Supprime l'avion qu'on vient de terminer la révision ...          	
                  } });
        		
        		//on affiche la boite de dialogue
        		adb.show();

			}
		});
	}

	private void maintenanceTerminer(String matriculeAvion, String duree, String date_revision){
		
		// On ajoute nos données dans une liste
        List nameValuePairs = new ArrayList(3);
        // On ajoute nos valeurs ici un login et le mot de passe
        nameValuePairs.add(new BasicNameValuePair("matricule", matriculeAvion));
        nameValuePairs.add(new BasicNameValuePair("duree", duree));
        nameValuePairs.add(new BasicNameValuePair("date_revision", date_revision));
        //Création d'un objet pour faire des demande HTTP
        ToolsHTTPandJASON Reponse = new ToolsHTTPandJASON();
        //Stock la valeur en mémoire pour eviter de faire l'appel 2x (car je fait un affichage dans le log console)
        String Requete = Reponse.RecuperationRequeteHTTP("http://10.0.2.2/script_fin_maintenance.php", nameValuePairs, PARSE_JSON);
        Log.i("INFO : ", Requete);
        Toast.makeText(getApplicationContext(), "Enregistrement effectué.", Toast.LENGTH_SHORT).show();
	}
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.activity_liste_maitenance, menu);
		return true;
	}

	public String recupereSeulementDate(String dateParam){
		StringTokenizer stringTokenizer = new StringTokenizer(dateParam, " : ");
		return stringTokenizer.nextToken();
	}
	public String convertirEnDateFr(String dateParam){
		
		StringTokenizer stringTokenizer = new StringTokenizer(dateParam, " : ");
		StringTokenizer stringTokenizer_d = new StringTokenizer(stringTokenizer.nextToken(), "-");
	    String annee = stringTokenizer_d.nextToken();
	    String mois = stringTokenizer_d.nextToken();
	    String jours = stringTokenizer_d.nextToken();
	     
	    Toast.makeText(getApplicationContext(), "Date convert : " + jours+"-"+mois+"-"+annee, Toast.LENGTH_SHORT).show();
		return jours+"-"+mois+"-"+annee;
	}
	
}
