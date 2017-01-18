#!/usr/bin/env bash

# Install libraries needed
composer install

# Create key for application
php artisan key:generate

# Create helper for IDE
php artisan ide-helper:generate

# Run migrations to create database
php artisan migrate

# Init admin account
php artisan add:admin --email=manhquan.do@ved.com.vn --role=admin

# Change chmod files and directories
chmod -R 777 public/files
chmod -R 777 storage
chmod -R 777 bootstrap

