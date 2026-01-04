package com.example.chefnextdoor;

import android.os.Bundle;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import java.util.ArrayList;

public class ChefListActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_chef_list);

        RecyclerView recyclerView = findViewById(R.id.recyclerChefs);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));

        // ---------- DATA ----------
        ArrayList<Integer> chefIds = new ArrayList<>();
        ArrayList<String> names = new ArrayList<>();
        ArrayList<String> ratings = new ArrayList<>();

        // ---------- CHEFS ----------
        chefIds.add(1);
        names.add("Chef Ayesha");
        ratings.add("4.8");

        chefIds.add(2);
        names.add("Chef Rahim");
        ratings.add("4.6");

        chefIds.add(3);
        names.add("Chef Nusrat");
        ratings.add("4.9");

        chefIds.add(4);
        names.add("Chef Karim");
        ratings.add("4.5");

        // ---------- ADAPTER ----------
        ChefAdapter adapter =
                new ChefAdapter(this, names, ratings, chefIds);

        recyclerView.setAdapter(adapter);
    }
}
