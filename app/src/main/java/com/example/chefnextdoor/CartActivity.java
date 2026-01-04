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

public class CartActivity extends AppCompatActivity {

    TextView txtSubtotal, txtDeliveryFee, txtGrandTotal;
    Button btnConfirmOrder;

    ArrayList<String> foods;
    ArrayList<Integer> prices;
    ArrayList<Integer> quantities;

    CartAdapter adapter;

    private static final int DELIVERY_FEE = 50;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cart);

        // ---------- UI ----------
        RecyclerView recyclerCart = findViewById(R.id.recyclerCart);
        txtSubtotal = findViewById(R.id.txtSubtotal);
        txtDeliveryFee = findViewById(R.id.txtDeliveryFee);
        txtGrandTotal = findViewById(R.id.txtGrandTotal);
        btnConfirmOrder = findViewById(R.id.btnConfirmOrder);

        recyclerCart.setLayoutManager(new LinearLayoutManager(this));

        // ---------- GET DATA ----------
        foods = getIntent().getStringArrayListExtra("foods");
        prices = getIntent().getIntegerArrayListExtra("prices");
        quantities = getIntent().getIntegerArrayListExtra("quantities");

        // ❌ SAFETY CHECK
        if (foods == null || prices == null || quantities == null) {
            Toast.makeText(this, "Cart data error", Toast.LENGTH_SHORT).show();
            finish();
            return;
        }

        // ---------- ADAPTER ----------
        adapter = new CartAdapter(
                foods,
                prices,
                quantities,
                this::updateTotals
        );

        recyclerCart.setAdapter(adapter);

        // ---------- INITIAL TOTAL ----------
        updateTotals();

        // ---------- CONFIRM ORDER ----------
        btnConfirmOrder.setOnClickListener(v -> {
            Intent intent = new Intent(CartActivity.this, OrderTrackingActivity.class);
            intent.putExtra("total", getSubtotal() + DELIVERY_FEE);
            startActivity(intent);
        });
    }

    // ---------- TOTAL CALCULATION ----------
    private void updateTotals() {
        int subtotal = getSubtotal();
        txtSubtotal.setText("Subtotal: ৳" + subtotal);
        txtDeliveryFee.setText("Delivery Fee: ৳" + DELIVERY_FEE);
        txtGrandTotal.setText("Grand Total: ৳" + (subtotal + DELIVERY_FEE));
    }

    private int getSubtotal() {
        int total = 0;
        for (int i = 0; i < foods.size(); i++) {
            total += prices.get(i) * quantities.get(i);
        }
        return total;
    }
}

