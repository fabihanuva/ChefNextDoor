# ChefNextDoor - Setup Instructions

Follow these steps to get the ChefNextDoor project running on your computer.

---

## 🚀 Quick Start (XAMPP)

### Step 1: Place Project in htdocs
Move this project folder to your XAMPP `htdocs` directory:
- **Windows:** `C:\xampp\htdocs\ChefNextDoor\`
- **Mac:** `/Applications/XAMPP/htdocs/ChefNextDoor/`

### Step 2: Install Dependencies
Open your terminal in the project folder and run:
```bash
composer install
```

### Step 3: Set Up Environment
Copy the example file:
```bash
cp .env.example .env
```
Open `.env` and set your database credentials. Ensure `BASE_PATH` is set correctly:
```env
BASE_PATH=/ChefNextDoor
```

### Step 4: Create Database
1. Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Create a new database named `chefnextdoor`
3. Select the database and go to the **Import** tab
4. Import `sql/schema.sql` first, then `sql/seed_posts.sql` (optional)

### Step 5: Access the App
Open [http://localhost/ChefNextDoor](http://localhost/ChefNextDoor) in your browser.

---

## 🛠️ Troubleshooting

| Problem | Solution |
|---|---|
| **404 Not Found** | Check that `BASE_PATH` in `.env` matches your folder name and `.htaccess` is present. |
| **Database Error** | Verify your DB credentials in `.env` and ensure the database exists. |
| **White Page** | Check PHP error logs or ensure `display_errors` is ON in `public/index.php`. |

---

## 📂 Project Structure

- `app/` - Core logic (Controllers, Models, Router)
- `public/` - Entry point and public assets
- `assets/` - CSS and JavaScript files
- `config/` - Database configuration
- `sql/` - Database schema and seed data
- `Views/` - HTML templates
