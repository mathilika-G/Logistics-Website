SHADOWWS | Logistics & Export Management System
This is a custom-built PHP/MySQL web application for an import-export business. It allows users to browse a product catalog and administrators to manage the inventory through a backend dashboard.

Key Features:

1.Inventory Management: Add, update, or remove products directly from the admin panel. 

2.Dynamic Catalog: Products are automatically grouped into categories like Furniture, Handicrafts, and Fruits & Vegetables. 

3.Smart Filtering: The navigation menu filters the catalog by category using URL parameters. 

4.Image Upload System: Automatically renames uploaded files with timestamps to keep the img/products/ folder organized. 

5.Product Modals: Detailed pop-ups for each item showing descriptions and source types. 

Project Structure:

> index.php: The main landing page with category overviews.

> products.php: The main catalog display where users can filter items.

> manage_products.php: The admin dashboard for handling product data.

>db_connect.php: Database configuration and connection script.

> /img/products/: Folder where all product images are stored.

How to Install:

> Move Files: Copy the project folder into your XAMPP htdocs directory.

> Database: Import the .sql file into phpMyAdmin.

> Configure: Update db_connect.php with your local database credentials.

> Permissions: Make sure the img/products/ folder has write permissions so uploads work correctly.

> Run: Visit http://localhost/Import_Export_Web/index.php in your browser.


Tech Stack:

Languages: PHP, JavaScript. 
Database: MySQL. 
UI Framework: Bootstrap 4. 
Icons: FontAwesome 5. 

Note for Git: I have added a .gitignore to keep the local img/products/ files out of the repository to keep it clean.
