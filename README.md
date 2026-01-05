🍽️ ChefNextDoor – Home Chef Food Ordering Android App

ChefNextDoor is an Android application that connects users with nearby home chefs.
Users can browse chefs, view chef profiles, explore menus, select food items with quantities, and place orders through a smooth and interactive interface.

This project was developed as part of an Android development academic project to demonstrate core concepts such as Activities, RecyclerView, Adapters, Intents, and dynamic UI updates.

📱 Features

👩‍🍳 Browse a list of available home chefs

⭐ View chef ratings and specialties

🧑‍🍳 Detailed chef profile with image, niche, and bio

🍛 Dynamic menu loading based on selected chef

➕➖ Increase or decrease food item quantities

💰 Real-time total price calculation

🛒 Cart validation before placing an order

🎯 Clean UI with reusable components


🛠️ Technologies Used

Language: Java

Platform: Android (Android Studio)

UI: XML layouts

Architecture: Activity-based with RecyclerView & Adapters

Minimum SDK: Compatible with modern Android versions


📂 Project Structure (Important Files)
com.example.chefnextdoor
│
├── ChefListActivity.java        # Displays list of chefs
├── ChefAdapter.java             # Adapter for chef RecyclerView
├── ChefProfileActivity.java     # Shows chef details
├── MenuActivity.java            # Displays chef menu
├── MenuAdapter.java             # Handles menu items & quantities
├── MenuItem.java                # Model class for food items
├── CartActivity.java            # Displays selected items
│
└── res/layout
    ├── activity_chef_list.xml
    ├── item_chef.xml
    ├── activity_chef_profile.xml
    ├── activity_menu.xml
    ├── item_menu.xml


🔄 Application Flow

ChefListActivity

Entry point of the app

Displays a list of chefs using RecyclerView

ChefProfileActivity

Opens when a chef is selected

Receives chef_id via Intent

Displays chef image, rating, niche, and bio

MenuActivity

Loads menu dynamically based on chef_id

Allows users to select food quantities

Updates total price in real time

Cart Validation

Ensures at least one item is selected before proceeding

🧠 Key Concepts Demonstrated

RecyclerView & ViewHolder pattern

Adapter-to-Activity communication using interfaces

Intent-based navigation with extras

Dynamic UI updates

Separation of concerns (UI, logic, data)

Scalable and reusable code structure

🎓 Learning Outcomes

Through this project, I gained hands-on experience in:

Building multi-screen Android applications

Managing complex UI interactions

Handling user input and state (quantities & totals)

Writing clean, readable, and maintainable Java code

Designing scalable app architecture

🚀 Future Improvements

Add real database (Firebase / Room)

User authentication

Order history and tracking

Payment gateway integration

Location-based chef discovery

👤 Author
Fabiha Nuva
Software Engineering Student
Metropolitan University, Sylhet

📌 Note
This project is created for educational purposes and demonstrates core Android development principles.
