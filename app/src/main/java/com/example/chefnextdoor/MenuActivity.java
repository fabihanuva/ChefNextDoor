package com.example.chefnextdoor;

import android.content.Intent;
import android.os.Bundle;

import androidx.appcompat.app.AppCompatActivity;

public class MenuActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu);

        findViewById(R.id.btnOrderNow).setOnClickListener(v ->
                startActivity(new Intent(this, OrderTrackingActivity.class)));
    }
}

