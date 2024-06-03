# PHP Developer Technical Assignment (CRUD Application with Reviews, API, and Admin Roles) Created by Praveen Prabhakaran

## Table of Contents

- [Project Overview](#project-overview)
- [Features](#features)
- [Project Structure](#project-structure)
- [Setup Instructions](#setup-instructions)
- [Usage](#usage)
- [API Usage with Postman](#api-usage-with-postman)

## Project Overview

This project is a PHP-based web application that includes CRUD operations for blogs, user authentication, user roles, reviews for blogs, and an API endpoint for fetching Blog data. It also implements responsive design.

## Features


## Features

- User registration with password hashing.
- User login and session management.
- Profile page with update functionality.
- CRUD operations for managing blogs.
- Reviews for blogs.
- API endpoint for blogs data retrieval.
- Admin role to manage users.
- Basic security measures including input sanitization.
- Basic CSS for styling and responsive design using Bootstrap 5

## Security and Validation

- Passwords are hashed using `password_hash`.
- User inputs are sanitized using `filter_var` and prepared statements.
- Basic validation is implemented in the form handling blocks.

## Project Structure

```
/project-root
    /apis
        auth.php
        list-blogs.php
    /assets
        /css
            style.css
        /js
            script.js
        /images
    /classes
        classBlog.php
        classDatabase.php
        classReview.php
        classUser.php
    /includes
        header.php
        footer.php
    
    register.php
    login.php
    profile.php
    crud.php
    admin.php
    index.php
    README.md
```

## Setup Instructions

### Prerequisites

- PHP 7.4 or later
- MySQL

### Steps

1. **Clone the repository**:

    ```sh
    git clone https://github.com/praveenplalu5010/PHP-Assignment.git
    cd project
    ```

2. **Setup a server**:

    - Install WAMP/XAMP server

3. **Setup the database**:

    - Create a MySQL database named `kelsius_db`.
    - Import the `kelsius_db.sql` file to create necessary tables.

    ```sh
    mysql -u username -p kelsius_db < kelsius_db.sql
    ```

4. **Configure the database connection**:

    - Update the `classes/classDatabase.php` file with your database credentials.

    ```php
    private $host = 'localhost';
    private $user = 'root';
    private $pass = 'yourpassword';
    private $dbname = 'kelsius_db';
    ```

5. **Run the application**:

    - Run the server and open the `index.php` file or browse you domain (http://localhost/your_project/).

## Usage

### Register a User

- Go to `/register.php` to create a new user.

### Login

- Go to `/login.php` to login.

### CRUD Operations

- After logging in, navigate to `/crud.php` to manage blogs and add reviews.

### Admin Page

- After the User registration, update any of the user with Admin role in the database manually (This is only for the initial time)
- Admins can go to `list-users.php` to manage users and update user roles.

## Using the API with Postman

To access the API endpoints using Postman, follow these steps:

1. Open Postman and create a new request.
2. Set the request type to `GET`.
3. Enter the API endpoint URL, e.g., `http://yourdomain.com/apis/list-blogs.php`.
4. Add the authentication token as a query parameter:
   - Key: `api_token`
   - Value: `[Your API Token]`
   - Some Valid API Tokens = "2K47aEsmX2dNqL0oPheWpZ7bC31V4fTl", "Gj9p5LqDzVx3hEwKtM4cW6sRy1gF2bXo", "Gj9p5LqDzVx3hEwKtM4cW6sRy1gF2bXo"
5. Send the request to retrieve JSON data.







## Using the API with Postman

To access the API endpoints using Postman, follow these steps:

1. Open Postman and create a new request.
2. Set the request type to `GET`.
3. Enter the API endpoint URL, e.g., `http://yourdomain.com/apis/list-blogs.php`.
4. Add the authentication token as a query parameter:
   - Key: `api_token`
   - Value: `[Your API Token]`
   - Some Valid API Tokens = "2K47aEsmX2dNqL0oPheWpZ7bC31V4fTl", "Gj9p5LqDzVx3hEwKtM4cW6sRy1gF2bXo", "Gj9p5LqDzVx3hEwKtM4cW6sRy1gF2bXo"
5. Send the request to retrieve JSON data.

