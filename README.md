# Basic Recipe

Basic Recipe is a website, without global styling or theme, written in PHP.

The goal of this project is to learn PHP.

You can post, modify or delete your own recipe.

Other users can read, comment and rate your recipe.

This website handle authentication with sessions.

All data are stored in a MySQL database (users, recipes, comments and ratings)

## Getting Started

### Prerequisites

This project uses the following tech stack:

-   [PHP](https://www.php.net/downloads)

-   [XAMPP](https://www.apachefriends.org/fr/index.html) for local MySQL database but you can use a cloud hosted one

### Instructions

1. Create the database locally or online
2. Clone the repo onto your computer
3. Create a credentials.php file in the database folder
4. INSERT DB_HOSTNAME, DB_PORT, DB_NAME, DB_USERNAME and DB_PASSWORD in credentials.php file as follow :

```php
<?php
define('DB_HOSTNAME', <your database URL>);
define('DB_PORT', <your database port>);
define('DB_NAME', <your database name>);
define('DB_USERNAME', <your database host username>);
define('DB_PASSWORD', <your database host password>);
?>
```

5. Open a terminal in the cloned project folder
6. Run the following commands:

```bash
# Start local dev server
php -S localhost:3000
```

Open [http://localhost:3000](http://localhost:3000) with your browser to see the result.
