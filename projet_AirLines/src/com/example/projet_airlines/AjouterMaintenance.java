package com.example.projet_airlines;

import java.sql.Date;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;

import android.os.Bundle;
import android.app.Activity;
import android.app.DatePickerDialog;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

public class AjouterMaintenance extends Activity {

	Button boutonEnregistrer;
	Button boutonChoixDateRevision;
	RevisionMaintenance revision = new RevisionMaintenance();
	EditText editTextMatricule;
	String dateRevision;
	DateFormat fmtDateAndTime = new SimpleDateFormat("yyyy-MM-dd"); //SimpleDateFormat("yyyyMMdd");// .getDateTimeInstance();
	Calendar dateAndTime = Calendar.getInstance();
	
	DatePickerDialog.OnDateSetListener d = new DatePickerDialog.OnDateSetListener()
	{
		public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
			dateAndTime.set(Calendar.YEAR, year);
			dateAndTime.set(Calendar.MONTH, monthOfYear);
			dateAndTime.set(Calendar.DAY_OF_MONTH, dayOfMonth);
			updateDateRev();
			//Toast.makeText(getApplicationContext(), fmtDateAndTime.format(dateAndTime.getTime()), Toast.LENGTH_LONG).show();
			//Toast.makeText(getApplicationContext(), dateRevision, Toast.LENGTH_LONG).show();
		}
	};
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_ajouter_maintenance);
		
		boutonEnregistrer = (Button)findViewById(R.id.buttonEnregistrerMaintenance);
		boutonChoixDateRevision = (Button)findViewById(R.id.buttonDateRevision);
		editTextMatricule = (EditText)findViewById(R.id.editTextImmatriculationAjoutMaintenance);
		
		
		boutonChoixDateRevision.setOnClickListener(new View.OnClickListener() {
			
			public void onClick(View v) {
				new DatePickerDialog(AjouterMaintenance.this,
						d,
						dateAndTime.get(Calendar.YEAR),
						dateAndTime.get(Calendar.MONTH),
						dateAndTime.get(Calendar.DAY_OF_MONTH)).show();
				
			}
		});
		
		boutonEnregistrer.setOnClickListener(new View.OnClickListener() {
			
			public void onClick(View v) {
				if(!editTextMatricule.getText().toString().equals("")){
					String JoursRevision = "0";
					//Spinner spJours 	=	(Spinner)findViewById(R.id.spinnerJourMaintenance);
					//Spinner spMois 		=	(Spinner)findViewById(R.id.spinnerMoisMaintenance);
					//Spinner spAnnees 	=	(Spinner)findViewById(R.id.spinnerAnneeMaintenance);
					
					Spinner spRevision  =	(Spinner)findViewById(R.id.spinnerChoixTypeMaintenance);
		            
					//spJours.getSelectedItem().toString();
		            int nPos = spRevision.getSelectedItemPosition();
		            if(nPos == 2){
		            	JoursRevision = "10";
		            }else{
		            	JoursRevision = "2";
		            }
		 
		            //String date = spAnnees.getSelectedItem().toString() + "-" + spMois.getSelectedItem().toString() + "-" + spJours.getSelectedItem().toString();
		            revision.AjouterUneMaintenance(dateRevision, editTextMatricule.getText().toString(), JoursRevision);
		            
		            
		            //Toast.makeText(getApplicationContext(), "getSelectedItem=" + spAnnees.getSelectedItem().toString(), Toast.LENGTH_LONG).show();
		            Toast.makeText(getApplicationContext(), "Enregistrement Réussi", Toast.LENGTH_LONG).show();
		            finish();
				}else{
					Toast.makeText(getApplicationContext(), "Veuillez saisir l'immatriculation de l'avion", Toast.LENGTH_LONG).show();
				}
			}
		});
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.activity_ajouter_maintenance, menu);
		return true;
	}
	
	public void updateDateRev(){
		this.dateRevision = fmtDateAndTime.format(dateAndTime.getTime());
	}

}
