<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
    <img src="https://img.shields.io/badge/PHP-8.1+-777BB4.svg?style=for-the-badge&logo=php&logoColor=white" alt="PHP Badge">
    <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Badge">
    <img src="https://img.shields.io/badge/License-Proprietary-red.svg?style=for-the-badge" alt="License Badge">
</p>

# VisionBoard

**VisionBoard** is a free, dynamic platform designed for sharing thoughtful posts and ideas. Built on the robust [Laravel](https://laravel.com) framework, it provides a secure and meaningful space for expression.

---

## 🛠 Prerequisites

Before starting, ensure your local machine supports the following:

-   **PHP**: Version 8.1 or higher.
-   **Composer**: Dependency manager for PHP.
-   **Node.js & NPM**: Required for building frontend assets.
-   **Database**: MySQL, MariaDB, or SQLite.

### 1. Install PHP (Windows)

We recommend using a local server environment like **[Laragon](https://laragon.org/download/)** or **[XAMPP](https://www.apachefriends.org/download.html)** which bundles PHP, Apache/Nginx, and MySQL.

_Alternatively, manually install PHP:_

1. Download the **Non Thread Safe** version from [windows.php.net](https://windows.php.net/download).
2. Extract to `C:\php`.
3. Add `C:\php` to your System Environment Variables `Path`.
4. Verify by running `php -v` in your terminal.

### 2. Install Composer

1. Download `Composer-Setup.exe` from [getcomposer.org](https://getcomposer.org/download/).
2. Run the installer and point it to your `php.exe`.
3. Verify by running `composer -v`.

### 3. Install Node.js

1. Download the LTS version from [nodejs.org](https://nodejs.org/).
2. Install and verify by running `node -v` and `npm -v`.

---

## 🚀 Local Installation

Follow these steps to set up a local development copy.

### 1. Clone the Repository

```bash
git clone https://github.com/ks-official-Sahan/VisionBoard.git
cd VisionBoard
```

### 2. Install Dependencies

Install PHP dependencies via Composer:

```bash
composer install
```

Install JavaScript dependencies via NPM:

```bash
npm install
```

### 3. Configure Environment

Create your `.env` file from the example configuration:

```bash
cp .env.example .env
```

Generate a unique application key:

```bash
php artisan key:generate
```

### 4. Database Setup

1. Create an empty database for the project (e.g., using phpMyAdmin or HeidiSQL, name it `visionboard`).
2. Open the `.env` file and update your database credentials:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=visionboard
DB_USERNAME=root
DB_PASSWORD=
```

3. Run migrations to create database tables:

```bash
php artisan migrate
```

### 5. Build Assets & Serve

Compile frontend assets:

```bash
npm run dev
```

In a **new terminal tab**, start the local development server:

```bash
php artisan serve
```

Access the application at: `http://127.0.0.1:8000`

---

## 🌍 Production Deployment

For deploying VisionBoard to a live server:

### 1. Environment Optimization

Ensure `.env` is set for production:

```ini
APP_ENV=production
APP_DEBUG=false
```

### 2. Install & Cache

Run composer with the optimization flag:

```bash
composer install --optimize-autoloader --no-dev
```

Cache configurations and routes for speed:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Build Frontend

Build minified assets for production:

```bash
npm run build
```

### 4. Storage Permissions

Ensure the server has write access to storage directories:

```bash
chmod -R 775 storage bootstrap/cache
```

```bash
php artisan storage:link
```

---

## 💻 Further Development

-   **Controllers**: Located in `app/Http/Controllers`.
-   **Models**: Located in `app/Models`.
-   **Views**: Blade templates in `resources/views`.
-   **Routes**: Web routes defined in `routes/web.php`.

To create a new Controller:

```bash
php artisan make:controller PostController
```

To create a new Model with Migration:

```bash
php artisan make:model Post -m
```

---

# 🛡️ Supreme Project Repository

Welcome to a project maintained, owned, or created under the exclusive rights of  
**Subasin Arachchige Sahan Sachintha** — CEO, Architect, and Supreme Owner of all source code, designs, IP, and revenue streams contained herein.

---

## 📦 Overview

This repository includes components, modules, or systems intended for internal, client, or commercial use.  
All assets are subject to **Supreme Proprietary License v1.0**, which **does not permit free usage** unless explicitly granted.

---

## 👑 Ownership & License

-   **© 2025 Subasin Arachchige Sahan Sachintha**
-   **License:** [LICENSE.md](./LICENSE.md)
-   **Protected by:** International IP, Cybersecurity, and Cybercrime laws
-   **Jurisdiction:** Colombo, Sri Lanka

---

## 🚫 Usage Restrictions

-   ❌ Redistribution without explicit permission is forbidden
-   ❌ Unauthorized modification is a violation of the license
-   ❌ Any monetization must include a **minimum 10% royalty or commission**

For legal use, licensing, or partnership inquiries, contact:

> 📧 **ks.official.sahan@gmail.com**  
> 📱 **+94 768 701148**

---

## 💼 Business & Legal Attribution

-   **Entity Name:** Evision IT (PVT) Ltd
-   **License Version:** Supreme Proprietary License v1.0
-   **Contact:** [GitHub Profile](https://github.com/ks-official-Sahan)

---

## ⚖️ Legal Notice

Any user or contributor acknowledges:

> “I accept that Subasin Arachchige Sahan Sachintha is the **sole intellectual and legal owner** of this codebase.  
> I shall not violate, reuse, sell, or clone any portion of this work without permission.”

---

## 🔐 Final Reminder

**Unauthorized use will trigger enforcement audits and possible legal actions.**

<!-- SUPREME_MARKER: README: 1d87e6f5-eabc-491c-a3e0-guard -->
