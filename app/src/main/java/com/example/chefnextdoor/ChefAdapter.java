package com.example.chefnextdoor;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.util.List;

public class ChefAdapter extends RecyclerView.Adapter<ChefAdapter.ChefViewHolder> {

    Context context;
    List<String> names;
    List<String> ratings;
    List<Integer> chefIds;

    public ChefAdapter(
            Context context,
            List<String> names,
            List<String> ratings,
            List<Integer> chefIds
    ) {
        this.context = context;
        this.names = names;
        this.ratings = ratings;
        this.chefIds = chefIds;
    }

    @NonNull
    @Override
    public ChefViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context)
                .inflate(R.layout.item_chef, parent, false);
        return new ChefViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ChefViewHolder holder, int position) {

        holder.txtChefName.setText(names.get(position));
        holder.txtRating.setText("⭐ " + ratings.get(position));

        holder.itemView.setOnClickListener(v -> {
            Intent intent = new Intent(context, ChefProfileActivity.class);
            intent.putExtra("chef_id", chefIds.get(position));
            context.startActivity(intent);
        });
    }

    @Override
    public int getItemCount() {
        return names.size();
    }

    static class ChefViewHolder extends RecyclerView.ViewHolder {

        TextView txtChefName, txtRating;

        ChefViewHolder(@NonNull View itemView) {
            super(itemView);
            txtChefName = itemView.findViewById(R.id.txtChefName);
            txtRating = itemView.findViewById(R.id.txtRating);
        }
    }
}
