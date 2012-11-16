package com.example.projet_airlines;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;
import android.view.View;
import android.widget.Button;

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
				
				
			}
		});
		
		boutonListeMaintenance.setOnClickListener(new View.OnClickListener() {
			
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
