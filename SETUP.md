# Setup Instructions

Follow these steps to get the AuthBoard starter project running on your computer.

---

## XAMPP Quick Start (Windows) — বাংলায় সেটআপ

### ধাপ ১: XAMPP ইনস্টল করো
[apachefriends.org](https://www.apachefriends.org/) থেকে XAMPP ডাউনলোড করে ইনস্টল করো। ইনস্টলের সময় **Apache** আর **MySQL** সিলেক্ট করা আছে কিনা দেখো।

### ধাপ ২: Composer ইনস্টল করো
[getcomposer.org](https://getcomposer.org/download/) থেকে Composer ডাউনলোড করে ইনস্টল করো। ইনস্টলের পর টার্মিনাল বন্ধ করে আবার খোলো।

### ধাপ ৩: প্রজেক্ট htdocs-এ রাখো
প্রজেক্ট ফোল্ডারটা কপি করে এখানে রাখো:
```
C:\xampp\htdocs\admin-board\
```

### ধাপ ৪: Dependencies ইনস্টল করো
Command Prompt খোলো, তারপর:
```bash
cd C:\xampp\htdocs\admin-board
composer install
```

### ধাপ ৫: Environment সেটআপ করো
```bash
copy .env.example .env
```
`.env` ফাইলটা কোড এডিটরে খুলে এগুলো সেট করো:
```env
DB_HOST=127.0.0.1
DB_NAME=authboard
DB_USER=root
DB_PASS=

BASE_PATH=/admin-board
```
> **গুরুত্বপূর্ণ:** `BASE_PATH=/admin-board` সেট করতে ভুলো না। ফোল্ডারের নাম যা দিবে, BASE_PATH-এও তাই দিতে হবে।

### ধাপ ৬: Database তৈরি করো
1. XAMPP Control Panel থেকে **Apache** আর **MySQL** স্টার্ট করো
2. ব্রাউজারে যাও: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
3. বাম পাশে **"New"** ক্লিক করো
4. Database-এর নাম দাও `authboard` আর **"Create"** ক্লিক করো
5. `authboard` সিলেক্ট করো, তারপর **"Import"** ট্যাবে যাও
6. **"Choose File"** ক্লিক করে প্রজেক্ট ফোল্ডার থেকে `sql/schema.sql` ফাইলটা সিলেক্ট করো
7. নিচে **"Go"** ক্লিক করো

### ধাপ ৭: ব্রাউজারে দেখো
ব্রাউজারে যাও: [http://localhost/admin-board](http://localhost/admin-board)

লগইন পেজ দেখা গেলে সব ঠিক আছে! এখন **Register** করে একটা অ্যাকাউন্ট বানাও।

### সমস্যা হলে

| সমস্যা | সমাধান |
|---|---|
| **সাদা পেজ দেখাচ্ছে** | `.env` ফাইলে database credentials ঠিক আছে কিনা চেক করো |
| **"Table doesn't exist"** | `sql/schema.sql` ইমপোর্ট করোনি। ধাপ ৬ আবার দেখো |
| **"Connection refused"** | XAMPP Control Panel থেকে MySQL চালু আছে কিনা দেখো |
| **CSS লোড হচ্ছে না** | `BASE_PATH` ঠিকমতো সেট করা আছে কিনা দেখো |
| **সব পেজে 404** | `.htaccess` ফাইলটা আছে কিনা দেখো। XAMPP-এ `mod_rewrite` ডিফল্টে চালু থাকে |

---

## What You Need Installed

Before starting, make sure you have these installed:

| Software | What It Does | Download Link |
|---|---|---|
| **PHP 8.0+** | Runs the backend code | Included with XAMPP/Laragon |
| **Composer** | Manages PHP packages | [getcomposer.org](https://getcomposer.org) |
| **MySQL** (or MariaDB) | Stores your data | Included with XAMPP/Laragon |
| **A code editor** | Write and edit code | [VS Code](https://code.visualstudio.com/) (free) |

> **Easiest option for beginners:** Install [XAMPP](https://www.apachefriends.org/) (Windows/Mac) or [Laragon](https://laragon.org/) (Windows only). These bundle PHP, MySQL, and a web server together so you do not have to install them separately.

---

## Step-by-Step Setup

### 1. Download the Project

**Option A — Using Git (recommended):**
```bash
git clone <your-repo-url>
cd admin-board
```

**Option B — Download ZIP:**
Download the ZIP file, extract it, and open the folder in your code editor.

---

### 2. Install Dependencies

Open a terminal in the project folder and run:

```bash
composer install
```

> **What does this do?** It downloads the PHP libraries the project needs (like PHPMailer for sending emails). You only need to run this once.

> **"composer: command not found"?** Make sure Composer is installed. Visit [getcomposer.org](https://getcomposer.org) and follow the installation guide for your operating system. After installing, close and reopen your terminal.

---

### 3. Set Up Environment Variables

Copy the example file to create your own config:

```bash
cp .env.example .env
```

> **On Windows (Command Prompt):** Use `copy .env.example .env` instead.

Open `.env` in your code editor and fill in your values:

```env
DB_HOST=127.0.0.1
DB_NAME=authboard
DB_USER=root
DB_PASS=

BASE_PATH=

MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USER=your_mailtrap_username
MAIL_PASS=your_mailtrap_password
```

**About each setting:**

| Variable | What to Put |
|---|---|
| `DB_HOST` | Usually `127.0.0.1` or `localhost` |
| `DB_NAME` | The database name you will create in the next step |
| `DB_USER` | Your MySQL username (default is `root` for XAMPP) |
| `DB_PASS` | Your MySQL password (often empty for XAMPP: leave blank) |
| `BASE_PATH` | Leave empty for `php -S` or set to `/admin-board` for XAMPP (see below) |
| `MAIL_HOST` | Your Mailtrap SMTP host |
| `MAIL_USER` | Your Mailtrap username |
| `MAIL_PASS` | Your Mailtrap password |

> **What is Mailtrap?** A free service that catches test emails so you do not accidentally send real emails during development. Sign up at [mailtrap.io](https://mailtrap.io), go to **Email Testing > Inboxes**, click your inbox, and copy the SMTP credentials.

---

### 4. Create the Database

Open your database tool (phpMyAdmin, TablePlus, MySQL Workbench, or the terminal).

**Option A — Using phpMyAdmin (easiest for XAMPP users):**
1. Open phpMyAdmin at [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Click **"New"** in the left sidebar
3. Type `authboard` as the database name and click **"Create"**
4. Select the `authboard` database
5. Click the **"Import"** tab at the top
6. Click **"Choose File"** and select `sql/schema.sql` from the project folder
7. Click **"Go"** at the bottom

**Option B — Using the terminal:**
```bash
mysql -u root -p -e "CREATE DATABASE authboard;"
mysql -u root -p authboard < sql/schema.sql
```

> **"Access denied"?** Try without `-p` if your MySQL has no password: `mysql -u root -e "CREATE DATABASE authboard;"`

---

### 5. Start the Server

Choose **one** of the two options below depending on your setup.

#### Option A — PHP Built-in Server (no XAMPP needed)

```bash
php -S localhost:8000
```

Make sure `BASE_PATH=` is empty (or not set) in your `.env` file.

Open [http://localhost:8000](http://localhost:8000) in your browser.

> **Keep this terminal open!** The server runs as long as the terminal is open. To stop it, press `Ctrl + C`.

> **"Port 8000 already in use"?** Try a different port: `php -S localhost:8001`

#### Option B — XAMPP (Apache)

1. Copy or move the project folder into XAMPP's `htdocs` directory:
   - **Windows:** `C:\xampp\htdocs\admin-board\`
   - **Mac:** `/Applications/XAMPP/htdocs/admin-board/`
2. Open your `.env` file and set: `BASE_PATH=/admin-board`
3. Start Apache and MySQL from the XAMPP Control Panel
4. Open [http://localhost/admin-board](http://localhost/admin-board) in your browser

> **Important:** The folder name in `htdocs` must match the `BASE_PATH` value. If you renamed the folder to `my-project`, set `BASE_PATH=/my-project`.

---

### 6. Test It Out

You should see the AuthBoard login page. Try registering a new account!

---

## Troubleshooting

| Problem | Solution |
|---|---|
| **Blank white page** | Your `.env` file is missing or has wrong database credentials. Check that the file exists and the values are correct. |
| **"Table doesn't exist"** | You forgot to import `sql/schema.sql`. Go back to Step 4. |
| **"Connection refused"** | Make sure MySQL is running. In XAMPP, open the control panel and click **Start** next to MySQL. |
| **Emails not sending** | Double-check your Mailtrap SMTP credentials in `.env`. Make sure you copied from the **SMTP** tab (not the API tab). |
| **CSS not loading / page looks broken** | Make sure you are accessing through `localhost:8000` or `localhost/admin-board`, not by opening the file directly in the browser. |
| **404 on all routes (XAMPP)** | Make sure `mod_rewrite` is enabled in Apache. In XAMPP, it is enabled by default. Also check that `BASE_PATH` in `.env` matches your folder name. |
| **Changes not showing up** | Hard-refresh your browser: `Cmd + Shift + R` (Mac) or `Ctrl + Shift + R` (Windows). |

---

## Project Structure

```
admin-board/
├── index.php              <- Entry point (all requests go through here)
├── .htaccess              <- Apache rewrite rules (routes requests to index.php)
├── app/
│   ├── Controllers/       <- Handle requests and logic
│   ├── Models/            <- Database queries
│   ├── Views/             <- HTML templates
│   ├── Core/              <- Router, Session, Controller, Mailer
│   └── helpers.php        <- Utility functions (url, requireAuth)
├── config/
│   └── database.php       <- Database connection
├── assets/
│   ├── style.css          <- All CSS styles
│   └── posts.js           <- Posts page JavaScript (infinite scroll)
├── sql/
│   ├── schema.sql         <- Database table definitions
│   └── seed_posts.sql     <- Sample data
├── vendor/                <- Composer packages (do not edit)
├── .env.example           <- Template for environment variables
├── .env                   <- Your local settings (do not commit this)
├── composer.json          <- PHP dependency list
├── README.md              <- Project guidelines
├── FEATURE_SUGGESTIONS.md <- Feature ideas with step-by-step guides
└── SETUP.md               <- You are here!
```

---

## What's Next?

Once the project is running:

1. Read the [Project Guidelines](README.md) to understand the requirements
2. Pick a project idea or use the starter as-is
3. Check [Feature Suggestions](FEATURE_SUGGESTIONS.md) for guided, step-by-step features you can add
