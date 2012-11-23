package com.example.projet_airlines;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;

public class AjouterMaintenance extends Activity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_ajouter_maintenance);
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.activity_ajouter_maintenance, menu);
		return true;
	}

}
