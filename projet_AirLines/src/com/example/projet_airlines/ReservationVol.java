package com.example.projet_airlines;

import java.util.HashMap;

import android.os.Bundle;
import android.app.Activity;
import android.app.AlertDialog;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.AdapterView.OnItemSelectedListener;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Spinner;
import android.widget.Toast;

public class ReservationVol extends Activity {

	ListView lvVol;
	Spinner spVilleDepart, spVilleArriver;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_reservation_vol);
		
		lvVol = (ListView)findViewById(R.id.listViewListeVol);
		spVilleArriver = (Spinner)findViewById(R.id.spinnerChoixPaysDepart);
		spVilleDepart = (Spinner)findViewById(R.id.SpinnerPaysArriver);
		
		String[] listString = {"Vol1", "Vol2", "Vol3"};
		String[] itemsSpinner = {"France","Allemagne","Etats Unis","Angleterre"};
		
		ArrayAdapter<String> aa = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_item, itemsSpinner);
		
		lvVol.setAdapter(new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, listString));
		
		spVilleArriver.setAdapter(aa);
		spVilleDepart.setAdapter(aa);
		
		chargementListeVolChoix(spVilleDepart.getSelectedItem().toString(),
								spVilleArriver.getSelectedItem().toString());

		lvVol.setOnItemClickListener(new OnItemClickListener() {

			public void onItemClick(AdapterView<?> arg0, View arg1, int position, long id) {
				// TODO Auto-generated method stub
				HashMap<String, String> map = (HashMap<String, String>) lvVol.getItemAtPosition(position);
        		map.get("titre");

			}
		});
		
		spVilleDepart.setOnItemSelectedListener(new OnItemSelectedListener() {

			public void onItemSelected(AdapterView<?> arg0, View arg1,
					int arg2, long arg3) {
				// TODO Auto-generated method stub
				chargementListeVolChoix(spVilleDepart.getSelectedItem().toString(),
						spVilleArriver.getSelectedItem().toString());
			}

			public void onNothingSelected(AdapterView<?> arg0) {
				// TODO Auto-generated method stub
				
			}

		});
		
		spVilleArriver.setOnItemSelectedListener(new OnItemSelectedListener() {

			public void onItemSelected(AdapterView<?> arg0, View arg1,
					int arg2, long arg3) {
				// TODO Auto-generated method stub
				chargementListeVolChoix(spVilleDepart.getSelectedItem().toString(),
						spVilleArriver.getSelectedItem().toString());
			}

			public void onNothingSelected(AdapterView<?> arg0) {
				// TODO Auto-generated method stub
				
			}

		});
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.activity_reservation_vol, menu);
		return true;
	}

	public void chargementListeVolChoix(String pDepart, String pArriver){
		Toast.makeText(getApplicationContext(), "pays depart : " + pDepart, Toast.LENGTH_SHORT).show();
		Toast.makeText(getApplicationContext(), "pays arriver : " + pArriver, Toast.LENGTH_SHORT).show();
		
		
	}
}
