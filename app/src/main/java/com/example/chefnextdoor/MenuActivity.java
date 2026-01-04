package com.example.chefnextdoor;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import java.util.ArrayList;

public class MenuActivity extends AppCompatActivity {

    MenuAdapter adapter;
    TextView txtTotal, txtChefName, txtChefNiche;
    Button btnPlaceOrder;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu);

        // ---------- UI ----------
        RecyclerView recyclerMenu = findViewById(R.id.recyclerMenu);
        txtTotal = findViewById(R.id.txtTotal);
        btnPlaceOrder = findViewById(R.id.btnPlaceOrder);
        txtChefName = findViewById(R.id.txtChefName);
        txtChefNiche = findViewById(R.id.txtChefNiche);

        recyclerMenu.setLayoutManager(new LinearLayoutManager(this));

        // ---------- DATA ----------
        ArrayList<String> foods = new ArrayList<>();
        ArrayList<Integer> prices = new ArrayList<>();
        ArrayList<Integer> images = new ArrayList<>();

        // ---------- GET CHEF ID ----------
        int chefId = getIntent().getIntExtra("chef_id", -1);

        // ---------- LOAD MENU ----------
        if (chefId == 1) {
            txtChefName.setText("Chef Ayesha’s Kitchen");
            txtChefNiche.setText("Homestyle Bengali & Biryani Specialist");

            foods.add("Chicken Biryani");
            prices.add(300);
            images.add(R.drawable.biriyani);

            foods.add("Morog Polao");
            prices.add(350);
            images.add(R.drawable.murogpolao);

            foods.add("Chicken Roast");
            prices.add(250);
            images.add(R.drawable.chicken_roast);

        } else if (chefId == 2) {
            txtChefName.setText("Chef Rahim’s Kitchen");
            txtChefNiche.setText("Traditional Dhakai Cuisine Expert");

            foods.add("Beef Rezala");
            prices.add(500);
            images.add(R.drawable.beefrezala);

            foods.add("Kacchi Biryani");
            prices.add(450);
            images.add(R.drawable.kacchi);

            foods.add("Beef Tehari");
            prices.add(420);
            images.add(R.drawable.tehari);

        } else if (chefId == 3) {
            txtChefName.setText("Chef Nusrat’s Kitchen");
            txtChefNiche.setText("Vegetarian & Comfort Food Specialist");

            foods.add("Vegetable Khichuri");
            prices.add(180);
            images.add(R.drawable.vegetablekichuri);

            foods.add("Beguni");
            prices.add(120);
            images.add(R.drawable.beguni);

            foods.add("Alur Chop");
            prices.add(100);
            images.add(R.drawable.alurchop);

        } else if (chefId == 4) {
            txtChefName.setText("Chef Karim’s Kitchen");
            txtChefNiche.setText("Meat and Fish Items Expert");

            foods.add("Kala Bhuna");
            prices.add(480);
            images.add(R.drawable.kalabhuna);

            foods.add("Hilsha Fish");
            prices.add(550);
            images.add(R.drawable.hilsha_fish);

            foods.add("Shrimp Polao");
            prices.add(220);
            images.add(R.drawable.shrimp_polao);

        } else {
            Toast.makeText(this, "Invalid chef selected", Toast.LENGTH_SHORT).show();
            finish();
            return;
        }

        // ---------- ADAPTER ----------
        adapter = new MenuAdapter(
                this,
                foods,
                prices,
                images,
                total -> txtTotal.setText("Total: ৳" + total)
        );

        recyclerMenu.setAdapter(adapter);

        // ---------- CONTINUE TO CART ----------
        btnPlaceOrder.setOnClickListener(v -> {

            if (adapter.getTotalQuantity() == 0) {
                Toast.makeText(
                        MenuActivity.this,
                        "Please select at least one item",
                        Toast.LENGTH_SHORT
                ).show();
                return;
            }

            Intent intent = new Intent(MenuActivity.this, CartActivity.class);
            intent.putStringArrayListExtra("foods", foods);
            intent.putIntegerArrayListExtra("prices", prices);
            intent.putIntegerArrayListExtra("quantities", adapter.getQuantities());

            startActivity(intent);
        });
    }
}

