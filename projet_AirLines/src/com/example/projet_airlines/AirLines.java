package com.example.projet_airlines;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

import com.example.projet_airlines.AirLines;
import com.example.projet_airlines.ChoixListeActivity;
import com.example.projet_airlines.ToolsHTTPandJASON;
import com.example.projet_airlines.Utilisateur;
import com.example.projet_airlines.R;

import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.app.Activity;
import android.content.Intent;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

public class AirLines extends Activity {

	private final boolean PARSE_JSON = true;
	EditText eTextLogin, eTextPass;
	static public Utilisateur User;
	//final Button buttonConnexion;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_air_lines);
        Log.i("DATA", "onCreate");
        //Initialisation de mes textBox
        eTextLogin = (EditText) findViewById(R.id.editText1);
        eTextPass = (EditText) findViewById(R.id.editText2);
        final Button buttonConnexion = (Button) findViewById(R.id.button1);
        
        		
        //Attend que l'on clique sur le bouton
        buttonConnexion.setOnClickListener(new View.OnClickListener() {
        	
			public void onClick(View v) {
				buttonConnexion.setClickable(false);//empeche les doubles clique!
				if(eTextLogin.length() > 1 && eTextPass.length() > 1){
					if(postData()){
						Intent intent = new Intent(AirLines.this, ChoixListeActivity.class);
						intent.putExtra("utilisateur", User);// besoin de "implements Parcelable" dans la classe Utilisateur
						Toast.makeText(getApplicationContext(), "Connexion Réussi.", Toast.LENGTH_SHORT).show();
						startActivity(intent);//lance l'activity des choix de l'utilisateur
						finish();//ferme l'activity primaire de connexion
					}else
						Toast.makeText(getApplicationContext(), "Erreur de connexion.", Toast.LENGTH_LONG).show();
				}
				else
					Toast.makeText(getApplicationContext(), "Veuillez remplir les champs.", Toast.LENGTH_LONG).show();
				buttonConnexion.setClickable(true);
			}
		});
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_air_lines, menu);
        return true;
    }
    
    public boolean postData() {
    	if(eTextLogin.length() > 1 || eTextPass.length() > 1){
	    	try {
	            // On ajoute nos données dans une liste
	            List nameValuePairs = new ArrayList(2);
	            //Log.i("DATA", "Initialisation");
	            // On ajoute nos valeurs ici un login et le mot de passe
	            //nameValuePairs.add(new BasicNameValuePair("android", "android_valeur"));
	            nameValuePairs.add(new BasicNameValuePair("login", eTextLogin.getText().toString()));
	            nameValuePairs.add(new BasicNameValuePair("passe", eTextPass.getText().toString()));
	            //Création d'un objet pour faire des demande HTTP
	            ToolsHTTPandJASON Reponse = new ToolsHTTPandJASON();
	            //Stock la valeur en mémoire pour eviter de faire l'appel 2x (car je fait un affichage dans le log console)
	            String Requete = Reponse.RecuperationRequeteHTTP("http://10.0.2.2/script.php", nameValuePairs, PARSE_JSON);
	            Log.i("DATA" , Requete);
	            JSONObject js = new JSONObject(Requete);  
	            if(js.getInt("id_utilisateur") > 0){
	            	User = new Utilisateur(eTextLogin.getText().toString(), eTextPass.getText().toString(), js.getInt("id_utilisateur"));
	            	return true;
	            }
	        } catch (Exception e) {
	        	Log.i("Erreur IO : ", e.getMessage());
	        }
    	}
    	else
			Log.i("Connexion", "Veuillez remplir les champs correctement... imbécile !");
    	return false;
    }
    
}
