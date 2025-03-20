# User Management System

### Project Overview

The project is an admin panel that allows performing CRUD operations on users.
Implemented on the MVC architecture using a functional approach.
The main goal of the project is to learn how to implement such functionality and understand how it works without using frameworks and third-party libraries.

### Features

* __Friendly URLs:__ .htaccess file provides simple and short URLs, sparing the project from file names in the address bar.
* __Routing:__ Implemented simple routing that checks routes, HTTP methods, and also calls the action of the specified controller and middleware.
* __CRUD:__ The project implements operations with database for adding, editing, deleting and displaying users.
* __Search:__ Search system allows you to find a user by ID, email address or name and display it in a table.
* __Templating:__ Templating on PHP allowing to render pages and parts of content.
* __Popup:__ Popup window for displaying messages or forms, implemented in the built-in templating.
* __Pagination:__ Pagination, which allows you to extract users from the database in parts, dividing the data into pages, navigation through which is carried out by a convenient interface.
* __Validation:__ Input validation system. In case of errors, error messages are displayed each under its own field.
* __Logging:__ Error logging system where log files are automatically entered by creation date into the log folder.
* __Autoload:__ Autoloading files with composer allows you to take full advantage of namespaces.

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
2. Set the base URL of your project in the `config/settings.php`.
```php
const BASE_URL = 'YOUR_BASE_URL'; // http://localhost (for example)
```
3. Configure Database. 

   3.1 Create a new database with name `ums` and import the prepared dump file `config/ums.sql`.
   
   3.2 Edit the database connection details in the `config/settings.php` file.
   ```php
    const DB_SETTINGS = [
        'driver' => 'mysql',
        'host' => 'your_host',
        'db_name' => 'your_db_name', // ums
        'username' => 'your_username',
        'password' => 'your_password',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'port' => 'your_port', // 3306
        'prefix' => '',
        'options' => [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
    ];
   ```
4. Install [Composer](https://getcomposer.org/) if you haven't already and run the following command in the project root using terminal.
```powershell
composer dump-autoload
```
5. Run the project on a server.

### Images

![Users panel page №1](https://github.com/imdvdv/user-management-system/blob/main/public/assets/img/preview/users1.png)
![Users panel page №2](https://github.com/imdvdv/user-management-system/blob/main/public/assets/img/preview/users2.png)
![Search user popup](https://github.com/imdvdv/user-management-system/blob/main/public/assets/img/preview/search-popup.png)
![Add user popup](https://github.com/imdvdv/user-management-system/blob/main/public/assets/img/preview/add-popup1.png)
![Add user popup with error](https://github.com/imdvdv/user-management-system/blob/main/public/assets/img/preview/add-popup2.png)
![Edit user popup](https://github.com/imdvdv/user-management-system/blob/main/public/assets/img/preview/edit-popup.png)
![Delete user popup](https://github.com/imdvdv/user-management-system/blob/main/public/assets/img/preview/delete-popup.png)