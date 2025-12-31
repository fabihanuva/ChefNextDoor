package com.example.chefnextdoor;

import android.content.Intent;
import android.os.Bundle;

import androidx.appcompat.app.AppCompatActivity;

public class HomeActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        findViewById(R.id.btnChef).setOnClickListener(v ->
                startActivity(new Intent(this, ChefProfileActivity.class)));

        findViewById(R.id.btnMenu).setOnClickListener(v ->
                startActivity(new Intent(this, MenuActivity.class)));

        findViewById(R.id.btnTrack).setOnClickListener(v ->
                startActivity(new Intent(this, OrderTrackingActivity.class)));
    }
}
