# Online Book Store API

This project is an Online Book Store Management System developed in PHP with a MySQL database. The system allows users to manage books, authors, and orders through a RESTful API.

## Table of Contents
- [Features](#features)
- [Setup](#setup)
- [API Endpoints](#api-endpoints)
  - [Books](#books)
  - [Authors](#authors)
  - [Orders](#orders)
- [Authentication](#authentication)
- [Contributing](#contributing)
- [License](#license)

## Features
- Manage books, authors, and orders.
- Token-based authentication for secure access.
- RESTful API implementation.

## Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL
- Postman

### Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/Katam08838/Online-Book-Store.git
    cd online-book-store
    ```

2. Install dependencies:
    ```sh
    composer install
    ```

3. Create a MySQL database and import the `db/schema.sql` file to set up the database schema.

4. Configure your database connection in `php/db_conn.php`:
    ```php
    <?php
    $dsn = 'mysql:host=localhost;dbname=online_book_store.db';
    $username = 'chandraharsha.nani@gmail.com';
    $password = '12345';

    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    ?>
    ```

5. Set up your environment variables for the JWT secret key in `php/func-auth.php`:
    ```php
    $jwt_secret = '12345';
    ```

### Running the Project
- Start the PHP built-in server:
    ```sh
    php -S localhost:8000
    ```

## API Endpoints

### Books

- **GET /api/books** - Retrieve a list of all books.
- **GET /api/books/{id}** - Retrieve details of a specific book by ID.
- **POST /api/books** - Add a new book.
- **PUT /api/books/{id}** - Update details of a specific book by ID.
- **DELETE /api/books/{id}** - Delete a specific book by ID.

### Authors

- **GET /api/authors** - Retrieve a list of all authors.
- **GET /api/authors/{id}** - Retrieve details of a specific author by ID.
- **POST /api/authors** - Add a new author.
- **PUT /api/authors/{id}** - Update details of a specific author by ID.
- **DELETE /api/authors/{id}** - Delete a specific author by ID.

### Orders

- **GET /api/orders** - Retrieve a list of all orders.
- **GET /api/orders/{id}** - Retrieve details of a specific order by ID.
- **POST /api/orders** - Add a new order.
- **PUT /api/orders/{id}** - Update details of a specific order by ID.
- **DELETE /api/orders/{id}** - Delete a specific order by ID.

## Authentication

This API uses token-based authentication. You need to authenticate and receive a token before accessing protected endpoints.

- **POST /api/login.php** - Authenticate and receive a JWT token.

### Example Login Request

```sh
POST /api/login.php
Content-Type: application/json

{
    "email": "chandraharsha.nani@gmail.com",
    "password": "12345"
}
