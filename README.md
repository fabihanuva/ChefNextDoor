# Web Application Final Project Guidelines

## What Is This Project?

You will build a **web application** — a website that actually does something useful. Think of apps you already use: Google Classroom, Instagram, or a banking app. You are building something similar, but simpler.

Every web app has two sides:

- **Frontend** — what users see and click on (HTML, CSS, JavaScript)
- **Backend** — what happens behind the scenes (PHP processes data, MySQL stores it)

Think of it like a restaurant: the frontend is the dining room (menus, decor, tables) and the backend is the kitchen (cooking, storing ingredients, managing orders).

### How a Request Flows Through the App

```
Browser Request
     |
     v
 index.php          <- Entry point. Loads everything and picks a route.
     |
     v
   Router            <- Matches the URL to a controller method.
     |
     v
 Controller          <- Runs the logic (check login, save data, etc.)
     |
     v
 Model (optional)    <- Talks to the database if needed.
     |
     v
   View              <- Renders the HTML page sent back to the browser.
     |
     v
  Response           <- The browser displays the page.
```

> **Ready to set up the project?** See the [Setup Instructions](SETUP.md) to get everything running on your computer.

### Quick Setup (XAMPP Windows) — দ্রুত সেটআপ

```
১. XAMPP ইনস্টল করো (apachefriends.org)
২. Composer ইনস্টল করো (getcomposer.org)
৩. প্রজেক্ট ফোল্ডার কপি করো → C:\xampp\htdocs\admin-board\
৪. Command Prompt-এ: cd C:\xampp\htdocs\admin-board && composer install
৫. copy .env.example .env → .env ফাইলে BASE_PATH=/admin-board সেট করো
৬. phpMyAdmin-এ authboard নামে database বানাও → sql/schema.sql ইমপোর্ট করো
৭. XAMPP-এ Apache + MySQL চালু করো
৮. ব্রাউজারে যাও → http://localhost/admin-board
```

> বিস্তারিত বাংলায় নির্দেশনা পেতে [SETUP.md](SETUP.md) দেখো।

---

## Key Goals

1. Build a **complete, working** web application from start to finish
2. Practice everything you learned — PHP, MySQL, HTML, CSS, and basic JavaScript
3. Create something real you can **show future employers** in your portfolio

---

## Technical Requirements

### Frontend (What Users See)

| What You Need | What It Means |
|---|---|
| HTML & CSS | Structure and style every page properly |
| CSS Framework | Use Bootstrap or Tailwind to make things look professional faster |
| Responsive Design | Your app must work on both phones and desktops |
| Form Validation | Check user input before submitting (e.g. "Email can't be empty") |
| Login & Signup Interface | Forms that let users create accounts and sign in |
| Protected Pages | Some pages should only be visible to logged-in users |

### Backend (PHP + MySQL)

| What You Need | What It Means |
|---|---|
| PHP for all logic | Handle forms, process requests, manage sessions |
| MySQL or SQLite database | Store and retrieve all your app's data |
| User Authentication | A working login and logout system with hashed passwords |
| Authorization | Control who can do what (e.g. only admins delete content, users only edit their own data) |
| Error Handling | Show friendly messages when something goes wrong, not blank pages or raw errors |
| CRUD Operations | Your app must let users **C**reate, **R**ead, **U**pdate, and **D**elete data |

### Database

| What You Need | What It Means |
|---|---|
| A clear schema | Plan your tables, columns, and data types before you start coding |
| A relationship diagram | A visual diagram showing how your tables connect to each other |
| At least 3-4 tables | A `users` table plus 2-3 tables specific to your project |

Use a free tool like [dbdiagram.io](https://dbdiagram.io) to draw your diagram.

---

## Required Pages

Every project must include these core pages:

| Page | Purpose |
|---|---|
| **Home Page** | Welcome page that explains what your app does |
| **Signup Page** | New user registration form |
| **Login Page** | Returning user login form |
| **Dashboard** | The main screen after login — shows the user's data |
| **Profile Page** | User can view and edit their own info |
| **Settings Page** | Change password, preferences, etc. |
| **404 Error Page** | A friendly "page not found" message for bad links |
| **Your project-specific pages** | Additional pages depending on what you are building |

---

## Project Ideas

### Beginner-Friendly (Simpler Scope)

| # | Project | Key Features | Tables You'd Need |
|---|---|---|---|
| 1 | **Personal To-Do List** | Add, edit, delete tasks; mark as done; filter by date or category | `users`, `tasks`, `categories` |
| 2 | **Simple Blog** | Write posts, comment on posts, edit and delete your own content | `users`, `posts`, `comments` |
| 3 | **Contact Book** | Store names, phones, emails; search and filter contacts | `users`, `contacts`, `groups` |
| 4 | **Expense Tracker** | Log daily spending, view totals by category and month | `users`, `expenses`, `categories` |
| 5 | **Class Notes Organizer** | Write or upload notes per subject, search through them | `users`, `subjects`, `notes` |
| 6 | **Simple Quiz App** | Create quizzes with questions, take quizzes, view scores | `users`, `quizzes`, `questions`, `results` |
| 7 | **Bookmark Manager** | Save website links by category, search, share collections | `users`, `bookmarks`, `tags` |
| 8 | **Habit Tracker** | Set daily habits, check them off, view streaks and progress | `users`, `habits`, `habit_logs` |
| 9 | **Flashcard Study App** | Create decks of flashcards, flip to study, track what you got right | `users`, `decks`, `cards`, `study_logs` |
| 10 | **Personal Diary / Journal** | Write daily entries, tag by mood, search past entries | `users`, `entries`, `moods` |

### Intermediate (More Features, More Tables)

| # | Project | Key Features | Tables You'd Need |
|---|---|---|---|
| 11 | **Student Portal** | Attendance tracking, grades, announcements per class | `users`, `classes`, `grades`, `announcements`, `attendance` |
| 12 | **Recipe Sharing Platform** | Post recipes, rate and review them, save favorites | `users`, `recipes`, `ratings`, `favorites`, `ingredients` |
| 13 | **Job Board** | Post jobs, apply with resume upload, search and filter listings | `users`, `jobs`, `applications` |
| 14 | **Library Management** | Book catalog, borrow and return tracking, due date alerts | `users`, `books`, `borrowings` |
| 15 | **Event Manager** | Create events, RSVP, calendar view, send reminders | `users`, `events`, `rsvps` |
| 16 | **Inventory System** | Add products, track stock levels, low-stock alerts, reports | `users`, `products`, `stock_movements` |
| 17 | **Classroom Poll / Voting** | Teacher creates polls, students vote, results shown live | `users`, `polls`, `options`, `votes` |
| 18 | **Online Marketplace** | List items for sale, add to cart, order history | `users`, `products`, `orders`, `order_items` |
| 19 | **Appointment Booking** | Service provider sets availability, clients book time slots | `users`, `services`, `time_slots`, `bookings` |
| 20 | **Fitness / Workout Logger** | Log workouts, track exercises and sets, view progress charts | `users`, `workouts`, `exercises`, `workout_logs` |

---

## Suggested Folder Structure

Keep your project organized. A clean folder structure makes everything easier to find and shows professionalism.

```
my-project/
├── index.php              <- Entry point (all requests go through here)
├── .htaccess              <- Apache rewrite rules
├── config/
│   └── database.php       <- Database connection
├── app/
│   ├── Controllers/       <- Handle requests and logic
│   ├── Models/            <- Database queries
│   ├── Views/             <- HTML templates
│   ├── Core/              <- Router, Session, Controller, Mailer
│   └── helpers.php        <- Utility functions
├── assets/
│   ├── css/style.css      <- Your custom styles
│   └── js/main.js         <- Your custom JavaScript
├── uploads/               <- User-uploaded files (if your app needs it)
├── sql/
│   └── schema.sql         <- All your CREATE TABLE statements
└── docs/
    ├── proposal.md        <- Project proposal
    ├── user-guide.md      <- How to use the app
    └── db-diagram.png     <- Your ER diagram image
```

---

## Required Documents

You must submit three documents alongside your code:

### 1. Project Proposal (1-2 pages)

Answer these questions:
- What problem does your app solve?
- Who are the target users?
- What features will it have? (list them)
- What makes your project interesting or useful?

**Example:** "My app helps university students organize their class notes by subject. Target users are students. Features: create subjects, add notes with titles and content, search through notes, tag notes by topic."

### 2. Technical Documentation (2-3 pages)

Include:
- Your database schema (list every table and its columns)
- An ER diagram showing relationships between tables
- Step-by-step setup instructions so someone else can run your app

**Example setup instructions:** "1. Create a MySQL database called `notes_app`. 2. Import the file `sql/schema.sql`. 3. Open `config/database.php` and enter your database username and password. 4. Open the project folder in your browser."

### 3. User Guide (1-2 pages)

Include:
- Screenshots of each main page
- Short explanation of what the user can do on each page
- Any frequently asked questions

**Example:** "On the Dashboard page, you will see all your notes listed by subject. Click 'Add Note' to create a new note. Click any note title to view or edit it."

---

## How You Will Be Graded

| Category | Weight | What the Instructor Looks For |
|---|---|---|
| **Technical Quality** | 50% | Does the app work? Is the code clean and organized? Are passwords stored safely? Are SQL queries protected from injection? Does it handle errors gracefully? |
| **Design & Usability** | 20% | Does it look presentable? Does it work on mobile? Is it easy to navigate? Are there loading indicators and pagination where needed? |
| **Documentation** | 10% | Can someone else set up and run your app from your instructions alone? Is there a clear user guide? |
| **Project Management** | 10% | Do you have a good Git commit history? Did you commit regularly with clear messages? |
| **Project Idea & Creativity** | 10% | Is the idea useful? Did you add thoughtful features beyond the bare minimum? |

---

## Tips to Do Well

- **Start early** — do not wait until the last week. Break the work into small weekly goals.
- **Commit to Git often** — aim for 20+ commits with clear messages like "Add login form" or "Fix dashboard query". Do not upload everything at the end in one commit.
- **Hash your passwords** — never store passwords as plain text. Use PHP's built-in hashing functions.
- **Use prepared statements** — never put user input directly into SQL queries. This prevents SQL injection attacks.
- **Test on mobile** — resize your browser or use developer tools to check how your app looks on small screens.
- **Ask for help early** — if you are stuck for more than 30 minutes on something, ask your instructor or classmates.
- **Keep it simple first** — get the basic version working, then add extra features. A simple app that works perfectly beats a complex app that is broken.

---

## Getting Started

1. Read the [Setup Instructions](SETUP.md) to get the starter project running
2. Pick a project idea from the tables above (or propose your own)
3. Plan your database tables and draw a diagram
4. Start building one feature at a time
5. See [Feature Suggestions](FEATURE_SUGGESTIONS.md) for step-by-step guides on adding features to the starter project
