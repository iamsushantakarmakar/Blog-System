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

git clone https://github.com/yourusername/laravel-blog-system.git
cd laravel-blog-system

text

### **Step 2: Install PHP Dependencies**

composer install

text

### **Step 3: Install JavaScript Dependencies**

npm install

text

### **Step 4: Environment Configuration**

Copy the `.env.example` file to `.env`:

cp .env.example .env

text

Generate application key:

php artisan key:generate

text

---

## ⚙️ Configuration

### **Database Configuration**

Edit your `.env` file with your database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_system
DB_USERNAME=root
DB_PASSWORD=your_password

text

### **Social Authentication (Optional)**

Configure Google and Facebook OAuth credentials in `.env`:

Google OAuth
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

Facebook OAuth
FACEBOOK_CLIENT_ID=your_facebook_app_id
FACEBOOK_CLIENT_SECRET=your_facebook_app_secret
FACEBOOK_REDIRECT_URI=http://localhost:8000/auth/facebook/callback

text

**Getting OAuth Credentials:**

- **Google**: [Google Cloud Console](https://console.cloud.google.com/)
- **Facebook**: [Facebook Developers](https://developers.facebook.com/)

### **Mail Configuration (Optional)**

For password reset functionality:

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@blog-system.com
MAIL_FROM_NAME="${APP_NAME}"

text

---

## 🗄️ Database Setup

### **Step 1: Create Database**

mysql -u root -p

text
undefined
CREATE DATABASE blog_system;
EXIT;

text

### **Step 2: Run Migrations**

php artisan migrate

text

### **Step 3: Seed Database (Optional)**

Populate with sample data:

php artisan db:seed

text

This creates:
- 1 Admin user (`admin@example.com` / `password`)
- 10 Regular users
- 30 Posts with comments

### **Step 4: Create Admin User Manually**

If not using seeders:

php artisan tinker

text
undefined
User::create([
'name' => 'Admin User',
'email' => 'admin@example.com',
'password' => bcrypt('password'),
'role' => 'admin'
]);

text

---

## 🚀 Running the Application

### **Development Server**

Start Laravel development server
php artisan serve

text
undefined
In a separate terminal, compile assets
npm run dev

text

Access the application at: [**http://localhost:8000**](http://localhost:8000)

### **Production Build**

Build optimized assets
npm run build

Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

text

---

## 🧪 Testing

### **Run All Tests**

php artisan test

text

### **Run Specific Test Suite**

Feature tests
php artisan test --testsuite=Feature

Unit tests
php artisan test --testsuite=Unit

text

### **Run with Coverage**

php artisan test --coverage

text

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

text

### **Authentication**

All API requests require authentication using Laravel Sanctum tokens.

**Get Token:**
POST /api/login
Content-Type: application/json

{
"email": "user@example.com",
"password": "password"
}

text

**Use Token:**
Authorization: Bearer {your-token}

text

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

text

**Response:**
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

text

---

## 📁 Project Structure

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

text

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
| User | (10 generated users) | password |

---

## 🌐 Deployment

### **Deployment Checklist**

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Configure production database
- [ ] Set up proper `.env` file
- [ ] Run `php artisan migrate --force`
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Set up SSL certificate
- [ ] Configure web server (Apache/Nginx)
- [ ] Set proper file permissions

### **Server Requirements**

Set storage permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

text

### **Recommended Hosting Providers**

- **VPS**: DigitalOcean, Linode, AWS EC2
- **Shared**: Laravel Forge, Cloudways
- **Platform**: Heroku, Railway, Render

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### **Code Standards**

- Follow PSR-12 coding standards
- Write unit tests for new features
- Update documentation as needed
- Use meaningful commit messages

---

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 🐛 Troubleshooting

### **Common Issues**

**Issue: RouteNotFoundException**
php artisan route:clear
php artisan config:clear
php artisan cache:clear

text

**Issue: Storage permission denied**
chmod -R 775 storage bootstrap/cache

text

**Issue: Social login not working**
- Verify OAuth credentials in `.env`
- Check callback URLs match exactly
- Enable APIs in Google/Facebook console

**Issue: Database connection failed**
- Verify MySQL is running
- Check database credentials in `.env`
- Ensure database exists

---

## 📞 Support

For issues and questions:

- **GitHub Issues**: [Create an issue](https://github.com/yourusername/laravel-blog-system/issues)
- **Email**: support@example.com
- **Documentation**: [Wiki](https://github.com/yourusername/laravel-blog-system/wiki)

---

## 🙏 Acknowledgments

- [Laravel Framework](https://laravel.com/)
- [Laravel Breeze](https://laravel.com/docs/11.x/starter-kits#breeze)
- [Laravel Socialite](https://laravel.com/docs/11.x/socialite)
- [Tailwind CSS](https://tailwindcss.com/)

---

## 📊 Project Statistics

- **Total Files**: 100+
- **Lines of Code**: 5,000+
- **Test Coverage**: 80%+
- **Dependencies**: 25+ packages

---

**Built with ❤️ using Laravel**
