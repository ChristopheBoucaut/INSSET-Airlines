package com.example.projet_airlines;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;

public class AirLines extends Activity {

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_air_lines);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_air_lines, menu);
        return true;
    }
}
