package com.example.chefnextdoor;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import java.util.UUID;

public class OrderTrackingActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_order_tracking);

        TextView txtOrderId = findViewById(R.id.txtOrderId);
        TextView txtOrderStatus = findViewById(R.id.txtOrderStatus);
        Button btnBackHome = findViewById(R.id.btnBackHome);

        // ---------- GENERATE ORDER ID ----------
        String orderId = "CN-" +
                UUID.randomUUID().toString()
                        .substring(0, 8)
                        .toUpperCase();

        txtOrderId.setText("Order ID: #" + orderId);

        // ---------- STATUS ----------
        txtOrderStatus.setText("Status: Preparing your food 🍳");

        // ---------- BACK TO HOME ----------
        btnBackHome.setOnClickListener(v -> {
            Intent intent = new Intent(this, HomeActivity.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
            startActivity(intent);
            finish();
        });
    }
}
