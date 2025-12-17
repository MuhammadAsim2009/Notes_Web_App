# 📝 Online Notes App

Online Notes App is a simple and secure web application built using **PHP** and **MySQL**.  
It allows users to register, log in, and manage their personal notes through a user-friendly dashboard.

---

## 🚀 Features

- User Registration
- User Login & Logout
- Session-based Authentication
- Add Notes
- Update Notes
- Delete Notes
- User Dashboard
- Secure Access (Login Required Pages)

---

## 🛠️ Technologies Used

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- Bootstrap

---

## 📁 Project Folder Structure

online-notes-app/
│
├── index.php
│
├── auth/
│ ├── login.php
│ ├── register.php
│ └── logout.php
│
├── dashboard/
│ └── dashboard.php
│
├── notes/
│ ├── add_notes.php
│ ├── update_notes.php
│ └── delete_notes.php
│
├── include/
│ ├── db.php
│ └── auth_check.php
│
├── database/
│ └── online_notes_app.sql
│
└── README.md

---

## ⚙️ Installation & Setup

1. Download or clone this repository
2. Move the project folder to `htdocs` (XAMPP)
3. Open **phpMyAdmin**
4. Create a new database (e.g. `online_notes`)
5. Import the SQL file:
database/online_notes_app.sql
6. Update database credentials in:
include/db.php
7. Run the project in browser:
http://localhost/online-notes/

---

## 🔐 Authentication Flow

- `index.php` redirects users to the login page
- Only logged-in users can access dashboard and notes
- Unauthorized users are redirected to login page using `auth_check.php`
