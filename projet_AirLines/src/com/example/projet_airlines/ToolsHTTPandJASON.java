package com.example.projet_airlines;
//package com.example.projet_airlines.R;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.List;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.util.Log;


public class ToolsHTTPandJASON {
	// ATTENTION NECESSITE SOUVENT <uses-permission android:name="android.permission.INTERNET"/>  				 <----- A LIRE 
		public String RecuperationRequeteHTTP(String URL, List nameValuePairs){
			// On créé un client http
			HttpClient httpclient = new DefaultHttpClient();
			// On créé notre entête
			HttpPost httppost = new HttpPost(URL);
			try {
				//Log.i("DATA", "URL : " + URL);
				// Ajoute la liste à notre entête
				httppost.setEntity(new UrlEncodedFormEntity(nameValuePairs));
				//Log.i("DATA", "Envois");
				// On exécute la requête tout en récupérant la réponse
				HttpResponse response = httpclient.execute(httppost);
				//Log.i("DATA", "Reception");
				InputStream is = null;
				HttpEntity entity = response.getEntity();
				//Log.i("DATA", "Entité de la réponse");
				is = entity.getContent();
				return ConvertIStoString(is);
			} catch (ClientProtocolException e) {
				Log.i("Erreur ClientProtocol : ", e.getMessage());
				return "Erreur";
			} catch (IOException e) {
				Log.i("Erreur IO : ", e.getMessage());
				return "Erreur";
			}
		}

		//HttpEntity -- InputSteam
		public String ConvertIStoString(InputStream is){
			// Convertion de la requète en string
			try{
				//Log.i("DATA", "Conversion is to String");
				BufferedReader reader = new BufferedReader(new InputStreamReader(is,"iso-8859-1"),8);
				StringBuilder sb = new StringBuilder();
				String line = null;
				while ((line = reader.readLine()) != null) {
					sb.append(line + "\n");
				}
				is.close();
				//Log.i("DATA", sb.toString());
				return ParseJSON(sb.toString()); // ATTENTION SI LES DONNEES SONT EN JSON LES ANALYSER AVEC la fonction ParseJSON(String DataJSON)
			}catch(Exception e){
				Log.e("log_tag", "Erreur de conversion du resultat " + e.toString());
				return "Erreur";
			}
		}

		public String ParseJSON(String DataJSON)
		{
			String returnString = "";
			// Parse les données JSON
			try{
				//Log.i("JSON", DataJSON);
				JSONArray jArray = new JSONArray(DataJSON);
				for(int i=0;i<jArray.length();i++){
					JSONObject json_data = jArray.getJSONObject(i);
					// Affichage ID_ville et Nom_ville dans le LogCat
					//Log.i("log_tag","login: "+json_data.getString("login"));
					// Résultats de la requète
					returnString += "\n\t" + jArray.getJSONObject(i); 
				}
			}catch(JSONException e){
				Log.e("log_tag", "Erreur dans l'analyse des données " + e.toString());
			}
			return returnString; 
		}
}
