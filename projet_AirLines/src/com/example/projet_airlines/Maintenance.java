package com.example.projet_airlines;

import android.os.Bundle;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

public class Maintenance extends Activity {

	Button boutonListeMaintenance;
	Button boutonAjouterMaintenance;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_maintenance);
		
		boutonListeMaintenance = (Button)findViewById(R.id.buttonListeMaintenance);
		boutonAjouterMaintenance = (Button)findViewById(R.id.buttonAjouterMaintenance);
		
		
		boutonListeMaintenance.setOnClickListener(new View.OnClickListener() {
			
			public void onClick(View v) {
				
				// Lance l'activity selon le choix de l'utilisateur
        		Intent intent = new Intent(Maintenance.this, ListeMaintenance.class);
				//intent.putExtra("utilisateur", user);// besoin de "implements Parcelable" dans la classe Utilisateur
				Toast.makeText(getApplicationContext(), "Liste Maintenance.", Toast.LENGTH_SHORT).show();
				startActivity(intent);//lance l'activity des choix de l'utilisateur
				//finish();//ferme l'activity primaire de connexion
			}
		});
		
		boutonAjouterMaintenance.setOnClickListener(new View.OnClickListener() {
			
			public void onClick(View v) {
				
				
			}
		});
		

	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.activity_maintenance, menu);
		return true;
	}

}
