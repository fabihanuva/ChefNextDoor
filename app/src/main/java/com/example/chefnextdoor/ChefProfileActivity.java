package com.example.chefnextdoor;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

public class ChefProfileActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_chef_profile);

        ImageView imgChef = findViewById(R.id.imgChef);
        TextView txtName = findViewById(R.id.txtChefName);
        TextView txtRating = findViewById(R.id.txtRating);
        TextView txtNiche = findViewById(R.id.txtNiche);
        TextView txtBio = findViewById(R.id.txtBio);
        Button btnViewMenu = findViewById(R.id.btnViewMenu);

        int chefId = getIntent().getIntExtra("chef_id", -1);

        if (chefId == 1) {
            imgChef.setImageResource(R.drawable.chef_ayesha);
            txtName.setText("Chef Ayesha");
            txtRating.setText("⭐ 4.8");
            txtNiche.setText("Homestyle Bengali & Biryani Specialist");
            txtBio.setText("Known for authentic homemade flavors and traditional recipes.");

        } else if (chefId == 2) {
            imgChef.setImageResource(R.drawable.chef_rahim);
            txtName.setText("Chef Rahim");
            txtRating.setText("⭐ 4.6");
            txtNiche.setText("Dhakai Traditional Cuisine");
            txtBio.setText("Expert in rich meat dishes and old Dhaka recipes.");

        } else if (chefId == 3) {
            imgChef.setImageResource(R.drawable.chef_nusrat);
            txtName.setText("Chef Nusrat");
            txtRating.setText("⭐ 4.9");
            txtNiche.setText("Vegetarian & Healthy Meals");
            txtBio.setText("Focused on nutritious, clean, and tasty food.");

        } else if (chefId == 4) {
            imgChef.setImageResource(R.drawable.chef_karim);
            txtName.setText("Chef Karim");
            txtRating.setText("⭐ 4.5");
            txtNiche.setText("Street Food & Snacks");
            txtBio.setText("Famous for crispy snacks and comfort food.");
        }

        btnViewMenu.setOnClickListener(v -> {
            Intent intent = new Intent(this, MenuActivity.class);
            intent.putExtra("chef_id", chefId);
            startActivity(intent);
        });
    }
}
