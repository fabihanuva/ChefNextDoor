package com.example.chefnextdoor;

import android.content.Intent;
import android.os.Bundle;

import androidx.appcompat.app.AppCompatActivity;

public class ChefProfileActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_chef_profile);

        findViewById(R.id.btnViewMenu).setOnClickListener(v ->
                startActivity(new Intent(this, MenuActivity.class)));
    }
}
