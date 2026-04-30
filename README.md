# 🍳 ChefNextDoor
### From Their Home to Your Heart

> A home-cooked food delivery platform connecting customers with talented home chefs in their community.

![ChefNextDoor](assets/images/logo.jpeg)

---

## 📌 Project Summary

ChefNextDoor is a full-stack web application built with PHP OOP, MySQL, HTML, Tailwind CSS and JavaScript. It allows home chefs to list and sell their home-cooked meals, and customers to browse, order and track deliveries — similar to a food delivery app but exclusively for home chefs.

**Built for:** Web Application Development — Final Project  
**Student:** Fabiha Nuva  
**Tech Stack:** PHP 8, MySQL, Tailwind CSS, JavaScript (Fetch API), XAMPP

---

## ✨ Key Features

### For Customers
- 🔐 Register and login with role selection
- 👨‍🍳 Browse home chefs with ratings and specialties
- 🍽️ View chef menus with live search (Ajax/Fetch)
- 🛒 Add dishes to cart with quantity controls
- 📦 Checkout with delivery address
- 📍 Live order tracking (Pending → Accepted → Preparing → Out for Delivery → Delivered)
- ⭐ Leave star ratings and reviews after delivery
- ❤️ Save favourite dishes

### For Chefs
- 👨‍🍳 Chef profile setup (bio, specialty, location)
- 🍽️ Full dish CRUD (Create, Read, Update, Delete) with image upload
- 📦 Order management with status pipeline
- 📊 Live dashboard with earnings, ratings and dish count
- ⭐ View all customer reviews

### General
- 🔒 Bcrypt password hashing
- 🛡️ PDO prepared statements (SQL injection protection)
- 📱 Responsive design (mobile + desktop)
- 🚫 Custom 404 error page
- 🏠 Landing page for new visitors

---

## 🗄️ Database Schema

7 tables: `users`, `chef_profiles`, `dishes`, `orders`, `order_items`, `reviews`, `favorites`

```sql
CREATE DATABASE chefnextdoor;
-- See sql/schema.sql for full schema
```

---

## ⚙️ Setup Guide

### Requirements
- XAMPP (Apache + PHP 8 + MySQL)
- Composer
- Web browser

### Step 1 — Clone the repository
```bash
git clone https://github.com/fabihanuva/ChefNextDoor.git
cd ChefNextDoor
```

### Step 2 — Install dependencies
```bash
composer install
```

### Step 3 — Create the database
1. Start Apache and MySQL from XAMPP Control Panel
2. Open `http://localhost/phpmyadmin`
3. Create a new database named `chefnextdoor`
4. Click the SQL tab and paste the contents of `sql/schema.sql`
5. Click Go

### Step 4 — Configure environment
Copy `.env.example` to `.env` and update:

DB_HOST=localhost
DB_NAME=chefnextdoor
DB_USER=root
DB_PASS=
BASE_PATH=/ChefNextDoor/public

### Step 5 — Enable Apache mod_rewrite (Mac/Linux)
Open `httpd.conf` and set:

AllowOverride All

Then restart Apache.

### Step 6 — Run the app
Open your browser and visit:

http://localhost/ChefNextDoor/public

---

## 📁 Project Structure

ChefNextDoor/
├── app/
│   ├── Controllers/     # AuthController, CustomerController, DishController...
│   ├── Models/          # User, Dish, ChefProfile, Review, Favorite
│   ├── Views/           # PHP view templates
│   └── Core/            # Router, Session, Controller, Mailer
├── assets/
│   └── images/          # Logo and static assets
├── config/
│   └── database.php     # PDO database connection
├── public/
│   └── index.php        # Application entry point + all routes
├── sql/
│   └── schema.sql       # Full database schema
├── uploads/
│   └── dishes/          # Uploaded dish images
└── vendor/              # Composer dependencies

---

## 🔐 Security Features

- ✅ Passwords hashed with `password_hash()` (BCRYPT)
- ✅ All queries use PDO prepared statements
- ✅ Role-based authorization (chef/customer)
- ✅ Session-based authentication
- ✅ Input validation and sanitization with `htmlspecialchars()`

---

## 📸 Screenshots

| Page | Description |
|------|-------------|
| Home | Landing page with hero section |
| Login | Split-screen login with logo |
| Register | Role selection (Chef/Customer) |
| Customer Dashboard | Quick action cards |
| Browse Chefs | Chef list with ratings |
| Chef Menu | Dishes with live search |
| Cart | Items with delivery fee |
| Order Tracking | Live pipeline status |
| Chef Dashboard | Stats, earnings, reviews |



---

## 👩‍💻 Author

**Fabiha Nuva**  
Web Application Development — Final Project  
© 2026 ChefNextDoor
