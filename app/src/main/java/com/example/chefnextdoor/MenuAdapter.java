package com.example.chefnextdoor;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.util.ArrayList;
import java.util.List;

public class MenuAdapter extends RecyclerView.Adapter<MenuAdapter.MenuViewHolder> {

    Context context;
    List<String> foods;
    List<Integer> prices;
    List<Integer> images;
    int[] quantities;
    TotalListener listener;

    public interface TotalListener {
        void onTotalChanged(int total);
    }

    public MenuAdapter(Context context,
                       List<String> foods,
                       List<Integer> prices,
                       List<Integer> images,
                       TotalListener listener) {

        this.context = context;
        this.foods = foods;
        this.prices = prices;
        this.images = images;
        this.listener = listener;
        quantities = new int[foods.size()];
    }

    @NonNull
    @Override
    public MenuViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context)
                .inflate(R.layout.item_menu, parent, false);
        return new MenuViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull MenuViewHolder holder, int position) {

        holder.txtFoodName.setText(foods.get(position));
        holder.txtPrice.setText("৳" + prices.get(position));
        holder.txtQuantity.setText(String.valueOf(quantities[position]));
        holder.imgFood.setImageResource(images.get(position));

        holder.btnPlus.setOnClickListener(v -> {
            quantities[position]++;
            holder.txtQuantity.setText(String.valueOf(quantities[position]));
            notifyTotal();
        });

        holder.btnMinus.setOnClickListener(v -> {
            if (quantities[position] > 0) {
                quantities[position]--;
                holder.txtQuantity.setText(String.valueOf(quantities[position]));
                notifyTotal();
            }
        });
    }

    private void notifyTotal() {
        int total = 0;
        for (int i = 0; i < quantities.length; i++) {
            total += quantities[i] * prices.get(i);
        }
        listener.onTotalChanged(total);
    }

    // 🔹 REQUIRED METHODS FOR CART
    public ArrayList<Integer> getQuantities() {
        ArrayList<Integer> list = new ArrayList<>();
        for (int q : quantities) list.add(q);
        return list;
    }

    public int getTotalQuantity() {
        int total = 0;
        for (int q : quantities) total += q;
        return total;
    }

    public int getTotalPrice() {
        int total = 0;
        for (int i = 0; i < quantities.length; i++) {
            total += quantities[i] * prices.get(i);
        }
        return total;
    }

    public ArrayList<String> getSelectedItems() {
        ArrayList<String> list = new ArrayList<>();
        for (int i = 0; i < quantities.length; i++) {
            if (quantities[i] > 0) {
                list.add(foods.get(i) + " x" + quantities[i]);
            }
        }
        return list;
    }

    @Override
    public int getItemCount() {
        return foods.size();
    }

    static class MenuViewHolder extends RecyclerView.ViewHolder {

        TextView txtFoodName, txtPrice, txtQuantity;
        Button btnPlus, btnMinus;
        ImageView imgFood;

        MenuViewHolder(@NonNull View itemView) {
            super(itemView);
            imgFood = itemView.findViewById(R.id.imgFood);
            txtFoodName = itemView.findViewById(R.id.txtFoodName);
            txtPrice = itemView.findViewById(R.id.txtPrice);
            txtQuantity = itemView.findViewById(R.id.txtQuantity);
            btnPlus = itemView.findViewById(R.id.btnPlus);
            btnMinus = itemView.findViewById(R.id.btnMinus);
        }
    }
}
