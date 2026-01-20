# 🛡️ LibraryPro - Advanced Admin Dashboard

**LibraryPro Admin Panel** is a centralized management system designed to handle library books, user memberships, and daily transactions. It features a modern **Glassmorphism** UI and real-time data tracking for efficient library operations.

---

## ✨ Key Features

* **Premium UI/UX**: Built with a modern gradient background and transparent Glassmorphism effects.
* **Live Statistics**: Displays real-time counts for Total Books, Active Members, and Daily Issues directly from the database.
* **Secure Access**: Implements a robust Admin Login and Session-based Logout system to prevent unauthorized access.
* **Quick Actions**: Shortcut modules for adding/editing books, managing user permissions, and viewing statistics.
* **Fully Responsive**: The dashboard is optimized for all screen sizes including Mobiles, Tablets, and Desktops.

---

## 🛠️ Tech Stack

* **Backend**: PHP (Procedural)
* **Database**: MySQL
* **Frontend**: HTML5, CSS3 (Custom Glass UI), Bootstrap 4.5
* **Icons**: Bootstrap Icons & Font Awesome 6

---

## 📂 Project Structure

```text
library_admin/
├── config/
│   └── db.php          # Database Connection Settings
├── admin_login.php     # Secure Admin Login Portal
├── admin_logout.php    # Session Destruction and Logout
├── dashboard.php       # Main Admin Overview (Stats & Actions)
├── manage_books.php    # Book Inventory Management Page
└── manage_users.php    # User Monitoring and Permissions
