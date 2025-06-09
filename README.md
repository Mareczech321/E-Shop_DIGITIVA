<p align="center">
  <h1 align="center">E-Shop_DIGITIVA</h1>
</p>
<p align="center">
  Empowering seamless shopping experiences, effortlessly delivered.

</p>

<div align="center">
  <img src="https://img.shields.io/badge/code-PHP-blue.svg" />
  <img src="https://img.shields.io/badge/last%20commit-today-brightgreen.svg" />
  <img src="https://img.shields.io/github/languages/count/Mareczech321/E-Shop_DIGITIVA.svg" />
  <img src="https://img.shields.io/badge/php-66.9%25-blue.svg" />
</div>

---

## Table of Contents

- [Overview](#overview)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Configuration](#configuration)
- [Usage](#usage)
- [Testing](#testing)
- [Features](#features)
- [Project Structure](#project-structure)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

---

## Overview

**E-Shop_DIGITIVA** is a robust e-commerce platform built to simplify online shopping experiences for both users and administrators.

---

## Getting Started

### Prerequisites

- PHP >= 7.4
- MySQL or MariaDB
- Composer
- Web server (e.g., Apache or PHP built-in server)

### Installation

1. Clone the repository:

```bash
git clone https://github.com/Mareczech321/E-Shop_DIGITIVA.git
cd E-Shop_DIGITIVA
```

2. Install dependencies (if using Composer):

```bash
composer install
```

---

## Configuration

Set up your configuration file:

```ini
DB_HOST=localhost
DB_NAME=eshop
DB_USER=root
DB_PASS=password
```

Import the database from `sql/schema.sql` using phpMyAdmin or terminal:

```bash
mysql -u root -p eshop < sql/schema.sql
```

Start a local PHP server:

```bash
php -S localhost:8000
```

---

## Usage

- **Homepage**: `/`
- **Register**: `register.php`
- **Login**: `login.php`
- **Admin Panel**: `/admin` (admin only)
- **Shopping Cart**: `/cart`
- **Products**: `/products`
- **Logout**: `logout.php`

---

## Testing

To run unit tests using PHPUnit (if configured):

```bash
./vendor/bin/phpunit tests
```

Manual testing:

- Register a new user
- Log in and verify access roles
- Add/remove items to/from the cart
- Manage products in the admin panel
- Validate form inputs and security

---

## Features

- ✅ User registration and login
- ✅ Role-based access (customer/admin)
- ✅ Product management (CRUD)
- ✅ Shopping cart functionality
- ✅ Basic session and input validation
- ✅ Clean and simple frontend

---

## Project Structure

```plaintext
/
├── admin/         ← product administration
├── cart/          ← shopping cart logic
├── products/      ← product listing
├── config/        ← database configuration
├── css/           ← stylesheets
├── img/           ← images and banners
├── sql/           ← database schema
├── index.php      ← main landing page
├── login.php      ← user login
├── register.php   ← user registration
├── logout.php     ← logout
└── vendor/        ← Composer dependencies
```

---

## Contributing

1. Fork this repository  
2. Create a new branch: `feature/your-feature`  
3. Make your changes and commit  
4. Open a Pull Request

---

## License

This project is licensed under the **MIT License**. See the `LICENSE` file for details.

---

## Contact

For suggestions, questions, or contributions:

- Open an issue on GitHub
