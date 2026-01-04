package com.example.chefnextdoor;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.util.ArrayList;

public class CartAdapter extends RecyclerView.Adapter<CartAdapter.CartViewHolder> {

    ArrayList<String> foods;
    ArrayList<Integer> prices;
    ArrayList<Integer> quantities;
    Runnable totalUpdater;

    public CartAdapter(
            ArrayList<String> foods,
            ArrayList<Integer> prices,
            ArrayList<Integer> quantities,
            Runnable totalUpdater
    ) {
        this.foods = foods;
        this.prices = prices;
        this.quantities = quantities;
        this.totalUpdater = totalUpdater;
    }

    @NonNull
    @Override
    public CartViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.item_cart, parent, false);
        return new CartViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull CartViewHolder holder, int position) {

        holder.txtFood.setText(foods.get(position));
        holder.txtQty.setText(String.valueOf(quantities.get(position)));
        holder.txtPrice.setText("৳" + prices.get(position));

        holder.btnPlus.setOnClickListener(v -> {
            quantities.set(position, quantities.get(position) + 1);
            notifyItemChanged(position);
            totalUpdater.run();
        });

        holder.btnMinus.setOnClickListener(v -> {
            if (quantities.get(position) > 1) {
                quantities.set(position, quantities.get(position) - 1);
                notifyItemChanged(position);
                totalUpdater.run();
            }
        });
    }

    @Override
    public int getItemCount() {
        return foods.size();
    }

    static class CartViewHolder extends RecyclerView.ViewHolder {

        TextView txtFood, txtQty, txtPrice;
        Button btnPlus, btnMinus;

        CartViewHolder(@NonNull View itemView) {
            super(itemView);
            txtFood = itemView.findViewById(R.id.txtCartFood);
            txtQty = itemView.findViewById(R.id.txtQty);
            txtPrice = itemView.findViewById(R.id.txtCartPrice);
            btnPlus = itemView.findViewById(R.id.btnPlus);
            btnMinus = itemView.findViewById(R.id.btnMinus);
        }
    }
}
