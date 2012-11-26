package com.example.projet_airlines;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

public class AjouterMaintenance extends Activity {

	Button boutonEnregistrer;
	RevisionMaintenance revision = new RevisionMaintenance();
	EditText editTextMatricule;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_ajouter_maintenance);
		
		boutonEnregistrer = (Button)findViewById(R.id.buttonEnregistrerMaintenance);
		editTextMatricule = (EditText)findViewById(R.id.editTextImmatriculationAjoutMaintenance);
		
		
		boutonEnregistrer.setOnClickListener(new View.OnClickListener() {
			
			public void onClick(View v) {
				String JoursRevision = "0";
				Spinner spJours 	=	(Spinner)findViewById(R.id.spinnerJourMaintenance);
				Spinner spMois 		=	(Spinner)findViewById(R.id.spinnerMoisMaintenance);
				Spinner spAnnees 	=	(Spinner)findViewById(R.id.spinnerAnneeMaintenance);
				
				Spinner spRevision  =	(Spinner)findViewById(R.id.spinnerChoixTypeMaintenance);
	            
				spJours.getSelectedItem().toString();
	            int nPos = spRevision.getSelectedItemPosition();
	            if(nPos == 2){
	            	JoursRevision = "10";
	            }else{
	            	JoursRevision = "2";
	            }
	 
	            String date = spAnnees.getSelectedItem().toString() + "-" + spMois.getSelectedItem().toString() + "-" + spJours.getSelectedItem().toString();
	            revision.AjouterUneMaintenance(date, editTextMatricule.getText().toString(), JoursRevision);
	            
	                Toast.makeText(getApplicationContext(), "getSelectedItem=" + spAnnees.getSelectedItem().toString(),
	                    Toast.LENGTH_LONG).show();
	                Toast.makeText(getApplicationContext(), "getSelectedItemPosition=" + nPos,
	                		Toast.LENGTH_LONG).show();
			}
		});
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.activity_ajouter_maintenance, menu);
		return true;
	}

}
