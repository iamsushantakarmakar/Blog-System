# Laravel Blog System

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=flat-square&logo=mysql)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

A comprehensive blog application built with Laravel 11, featuring user authentication, role-based access control, post management, comments system, and admin panel with advanced features.

## 📋 Table of Contents

- [Features](#features)
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Testing](#testing)
- [API Documentation](#api-documentation)
- [Project Structure](#project-structure)
- [Usage Guide](#usage-guide)
- [Deployment](#deployment)
- [Contributing](#contributing)
- [License](#license)

---

## ✨ Features

### **Authentication & Authorization**
- ✅ User registration with email and password
- ✅ Secure login/logout functionality
- ✅ Social authentication (Google, Facebook)
- ✅ Password reset and recovery
- ✅ Role-based access control (Admin, Regular User)
- ✅ Custom middleware for role verification

### **Post Management**
- ✅ Create, Read, Update, Delete (CRUD) operations
- ✅ Soft deletes with restore functionality
- ✅ Rich text content support
- ✅ Author attribution and timestamps
- ✅ Post ownership validation
- ✅ Eloquent ORM relationships

### **Comments System**
- ✅ User comments on posts
- ✅ Comment CRUD operations
- ✅ Nested relationships (Post → Comments → User)
- ✅ Comment ownership verification
- ✅ Real-time comment display

### **Admin Panel**
- ✅ Comprehensive admin dashboard
- ✅ User management (view, edit roles, delete)
- ✅ Post management (view all, delete, restore)
- ✅ Statistics dashboard (posts, users, comments count)
- ✅ Activity logs and monitoring
- ✅ Middleware-protected routes

### **Advanced Features**
- ✅ Route model binding
- ✅ Named routes and route groups
- ✅ Custom service providers
- ✅ User activity logging middleware
- ✅ Query optimization with eager loading
- ✅ Caching for improved performance
- ✅ RESTful API for mobile applications
- ✅ Comprehensive unit and feature tests

---

## 🖥️ System Requirements

- **PHP**: >= 8.2
- **Composer**: >= 2.0
- **Node.js**: >= 18.x
- **NPM**: >= 9.x
- **MySQL**: >= 8.0 or MariaDB >= 10.3
- **Web Server**: Apache or Nginx
- **Laravel**: 11.x

### **Recommended**
- **RAM**: Minimum 2GB
- **Storage**: 500MB free space
- **Operating System**: Ubuntu 20.04+, macOS, or Windows 10+

---

## 📦 Installation

### **Step 1: Clone the Repository**
```bash
git clone https://github.com/iamsushantakarmakar/Blog-System.git
cd Blog-System
```

### **Step 2: Install PHP Dependencies**
```bash
composer install
```

### **Step 3: Install JavaScript Dependencies**
```bash
npm install
```

### **Step 4: Environment Configuration**

Copy the `.env.example` file to `.env`:
```bash
cp .env.example .env
```

Generate application key:
```bash
php artisan key:generate
```

---

## ⚙️ Configuration

### **Database Configuration**

Edit your `.env` file with your database credentials:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_system
DB_USERNAME=root
DB_PASSWORD=your_password
```

### **Social Authentication (Optional)**

Configure Google and Facebook OAuth credentials in `.env`:

Google OAuth
```bash
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```
Facebook OAuth
```bash
FACEBOOK_CLIENT_ID=your_facebook_app_id
FACEBOOK_CLIENT_SECRET=your_facebook_app_secret
FACEBOOK_REDIRECT_URI=http://localhost:8000/auth/facebook/callback
```

**Getting OAuth Credentials:**

- **Google**: [Google Cloud Console](https://console.cloud.google.com/)
- **Facebook**: [Facebook Developers](https://developers.facebook.com/)

---

## 🗄️ Database Setup

### **Step 1: Create Database**
```bash
mysql -u root -p
CREATE DATABASE blog_system;
EXIT;
```

### **Step 2: Run Migrations**
```bash
php artisan migrate
```

### **Step 3: Seed Database**

Populate with sample data:
```bash
php artisan db:seed
```

This creates:
- 1 Admin user (`admin@example.com` / `password`)
- 10 Regular users
- 30 Posts with comments

---

## 🚀 Running the Application

### **Development Server**

Start Laravel development server
```bash
php artisan serve
```

In a separate terminal, compile assets
```bash
npm run dev
```

Access the application at: [**http://localhost:8000**](http://localhost:8000)

### **Production Build**

Build optimized assets
```bash
npm run build
```
Optimize Laravel
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🧪 Testing

### **Run All Tests**
```bash
php artisan test
```

### **Run Specific Test Suite**

Feature tests
```bash
php artisan test --testsuite=Feature
```
Unit tests
```bash
php artisan test --testsuite=Unit
```

### **Run with Coverage**
```bash
php artisan test --coverage
```

### **Test Categories**

- **Authentication Tests**: User registration, login, logout
- **Post Tests**: CRUD operations, authorization
- **Comment Tests**: Creating, deleting comments
- **Admin Tests**: Dashboard access, user management
- **Middleware Tests**: Role verification, activity logging

---

## 📡 API Documentation

### **Base URL**
http://localhost:8000/api


### **Authentication**

All API requests require authentication using Laravel Sanctum tokens.

**Get Token:**
```bash
POST /api/login
Content-Type: application/json

{
"email": "user@example.com",
"password": "password"
}
```

**Use Token:**
```bash
Authorization: Bearer {your-token}
```

### **Endpoints**

#### **Posts**

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET | `/api/posts` | Get all posts | ✅ |
| GET | `/api/posts/{id}` | Get single post | ✅ |
| POST | `/api/posts` | Create new post | ✅ |
| PUT | `/api/posts/{id}` | Update post | ✅ (Owner/Admin) |
| DELETE | `/api/posts/{id}` | Delete post | ✅ (Owner/Admin) |

#### **Comments**

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET | `/api/posts/{id}/comments` | Get post comments | ✅ |
| POST | `/api/posts/{id}/comments` | Create comment | ✅ |
| DELETE | `/api/comments/{id}` | Delete comment | ✅ (Owner/Admin) |

### **Example API Request**

curl -X GET http://localhost:8000/api/posts
-H "Authorization: Bearer your-token-here"
-H "Accept: application/json"


**Response:**
```bash
{
"data": [
{
"id": 1,
"title": "My First Post",
"content": "Post content here...",
"user": {
"id": 1,
"name": "John Doe"
},
"comments_count": 5,
"created_at": "2025-10-26T12:00:00.000000Z"
}
]
}
```

---

## 📁 Project Structure
```bash
laravel-blog-system/
├── app/
│ ├── Http/
│ │ ├── Controllers/
│ │ │ ├── Admin/
│ │ │ │ ├── DashboardController.php
│ │ │ │ ├── UserController.php
│ │ │ │ └── PostController.php
│ │ │ ├── Api/
│ │ │ │ ├── PostController.php
│ │ │ │ └── CommentController.php
│ │ │ ├── Auth/
│ │ │ │ ├── AuthenticatedSessionController.php
│ │ │ │ ├── RegisteredUserController.php
│ │ │ │ └── SocialAuthController.php
│ │ │ ├── PostController.php
│ │ │ └── CommentController.php
│ │ ├── Middleware/
│ │ │ ├── AdminMiddleware.php
│ │ │ ├── LogUserActivity.php
│ │ │ └── CheckPostOwnership.php
│ │ └── Requests/
│ ├── Models/
│ │ ├── User.php
│ │ ├── Post.php
│ │ ├── Comment.php
│ │ └── UserActivity.php
│ ├── Policies/
│ │ ├── PostPolicy.php
│ │ └── CommentPolicy.php
│ └── Providers/
│ └── BlogServiceProvider.php
├── database/
│ ├── factories/
│ ├── migrations/
│ └── seeders/
├── resources/
│ └── views/
│ ├── admin/
│ ├── auth/
│ ├── posts/
│ └── layouts/
├── routes/
│ ├── api.php
│ ├── web.php
│ └── auth.php
├── tests/
│ ├── Feature/
│ └── Unit/
├── .env.example
├── composer.json
├── package.json
└── README.md
```

---

## 📖 Usage Guide

### **For Regular Users**

1. **Register an Account**
   - Visit `/register`
   - Fill in name, email, password
   - Or use "Continue with Google/Facebook"

2. **Create a Post**
   - Login and click "Create New Post"
   - Enter title and content
   - Submit to publish

3. **Manage Your Posts**
   - View all posts at `/posts`
   - Edit/Delete your own posts
   - Add comments to any post

### **For Administrators**

1. **Access Admin Dashboard**
   - Login with admin credentials
   - Automatically redirected to `/admin/dashboard`

2. **Manage Users**
   - View all registered users
   - Change user roles (admin/user)
   - Delete user accounts

3. **Manage Posts**
   - View all posts (including soft-deleted)
   - Permanently delete or restore posts
   - Monitor post statistics

### **Default Credentials**

After running seeders:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| User | (user email id or social login) | password |

---

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 🐛 Troubleshooting

### **Common Issues**

**Issue: RouteNotFoundException**
```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
```

**Issue: Storage permission denied**
```bash
chmod -R 775 storage bootstrap/cache
```

**Issue: Social login not working**
- Verify OAuth credentials in `.env`
- Check callback URLs match exactly
- Enable APIs in Google/Facebook console

**Issue: Database connection failed**
- Verify MySQL is running
- Check database credentials in `.env`
- Ensure database exists

---
