# ToolSathi - cPanel Shared Hosting Deployment Guide

This guide details the complete procedure for deploying **ToolSathi** on cPanel shared hosting.

## 1. Prerequisites & Server Requirements
- **PHP Version**: PHP 8.2 or higher (PHP 8.3 recommended).
- **Required PHP Extensions**: `OpenSSL`, `PDO`, `Mbstring`, `Tokenizer`, `XML`, `Ctype`, `JSON`, `Fileinfo`, `BCMath`.
- **Database**: MySQL 5.7+ or MariaDB 10.3+.

## 2. Database Setup
1. Log in to your cPanel and open **MySQL Database Wizard**.
2. Create a database (e.g., `username_toolsathi`).
3. Create a database user with a secure password and grant **All Privileges** to the database.

## 3. File Upload & Directory Structure
1. Upload the project archive (`toolsathi.zip`) to your server via cPanel File Manager or SFTP.
2. Extract files such that the `toolsathi` folder resides outside `public_html` (e.g., in `/home/username/toolsathi`), or directly in your home directory.
3. Point your domain or subdomain document root (`public_html`) to the Laravel public folder:
   - Path: `/home/username/toolsathi/public`

## 4. Environment Configuration
1. In `/home/username/toolsathi`, locate `.env.example` and rename it to `.env`.
2. Update the environment variables for production:
   ```env
   APP_NAME=ToolSathi
   APP_ENV=production
   APP_KEY=base64:...
   APP_DEBUG=false
   APP_URL=https://yourdomain.com

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=username_toolsathi
   DB_USERNAME=username_dbuser
   DB_PASSWORD=your_secure_password
   ```

## 5. Composer & Asset Optimization
1. Run Composer to install production dependencies:
   ```bash
   composer install --optimize-autoloader --no-dev
   ```
2. Build production frontend assets:
   ```bash
   npm run build
   ```

## 6. Storage Permissions & Migrations
1. Ensure correct permissions for storage and cache:
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```
2. Run database migrations and seeders:
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```
3. Create storage symbolic link for public file access:
   ```bash
   php artisan storage:link
   ```

## 7. Cron Job Setup
In cPanel **Cron Jobs**, add a recurring task every minute:
```bash
* * * * * /usr/local/bin/php /home/username/toolsathi/artisan schedule:run >> /dev/null 2>&1
```

## 8. Admin Login Instructions
- **URL**: `https://yourdomain.com/login` (or `/admin`)
- **Default Email**: `admin@toolsathi.com`
- **Default Password**: `password` *(Change immediately upon first login)*
