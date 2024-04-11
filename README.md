# User Management System

### Project Overview

The fullstack project that is an admin panel that allows you to perform CRUD operations on users.
Implemented on REST architecture for communicating with the server at specified endpoints. The backend of the project is written in PHP, and the frontend in Javascript.
The main goal of the project is to learn how to implement such functionality and understand how they work without using frameworks and third-party libraries.

### Features

* __Create:__ Ability to add a new user to the database by entering his personal data in the form.
* __Read:__ Ability to display user data from the database on a page in an intuitive table.
* __Update:__ Ability to edit user data.
* __Delete:__ Ability to remove a user from the database.
* __Friendly URLs:__ .htaccess file provides simple and short URLs, sparing the project from file names in the address bar.
* __Routing:__ Custom routing implemented using a functional approach using PHP.
* __Search:__ Custom search bar allows you to find a user by ID email address or name and display it in a table.
* __Pagination:__ Custom pagination implemented in Javascript that allows you to fill a table with data and split it into pages.
* __Validation:__ Custom validation of input data before sending using JavaScript and additional validation on the server side. In case of errors, error messages are displayed each under its own field.
* __Popup:__ Custom popup for displaying messages or forms that the function retrieves using fetch JS from the components directory.

### Components

__Languages__
* PHP-8.2.4
* JavaScript
* MariaDB-10.4.28
* HTML5
* CSS3

__Development Environment__
* Apache-2.4

__External Resources/Plugins__
* Font awesome-6.4.0
* Google Fonts


### Getting Started

To use this project, follow these steps:
1. Clone the repository to your local machine.
2. Create a new database and import the database.sql file.
3. Configure Database.

   3.1 Create a new database with name `ums` and import the prepared dump file `src/config/ums.sql`.
   
   3.2 Edit the database connection details in the `src/config/env.php` file.

   ```php
    // Database params
   const DB_HOST = "your DB Host", // "localhost" for local server
       DB_NAME = "your DB Name", // "ums" if you decide to use the database dump attached to the project
       DB_USERNAME = "your DB UserName", // "root" for phpMyAdmin
       DB_PASSWORD = "your DB Password", // "password" or without password for phpMyAdmin
       DB_PORT = "your DB Port"; // usually 3306
   ```

4. Run the project on a server.

### Images

![Admin panel1](https://github.com/imdvdv/user-management-system/blob/main/assets/img/panel1.png)
![Admin panel2](https://github.com/imdvdv/user-management-system/blob/main/assets/img/panel2.png)
![Edit user popup](https://github.com/imdvdv/user-management-system/blob/main/assets/img/edit-popup.png)
![Delete user popup](https://github.com/imdvdv/user-management-system/blob/main/assets/img/delete-popup.png)
