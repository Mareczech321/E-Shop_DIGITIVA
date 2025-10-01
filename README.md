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

**E-Shop DIGITIVA** is a prototype of e-commerce platform built to simplify online shopping experiences for both users and administrators.

---

## Getting Started

### Prerequisites

- PHP >= 7.4
- MySQL or MariaDB
- Web server (e.g., Apache or PHP built-in server)

### Installation

1. Clone the repository:

```bash
git clone https://github.com/Mareczech321/E-Shop_DIGITIVA.git
cd E-Shop_DIGITIVA
```

2. Install dependencies

---

## Configuration

Set up your configuration file:

```ini
DB_HOST="localhost"
DB_NAME="eshop"
DB_USER="root"
DB_PASS="password"
```

Import the database `marekmulacwz6820.sql` using phpMyAdmin

Start a local PHP server:

```bash
php -S localhost:8000
```

---

## Usage

- **Homepage**: `localhost/[projectName]` or `yourDomain.com`
  - **Register**: `/register.php`
  - **Login**: `/login.php`
  - **Admin Panel**: `/ADMIN-PANEL` (admin only)
  - **Shopping Cart**: `/CART`
  - **Products**: `/PRODUCTS`
  - **Logout**: `/logout.php`

---

## Manual testing:

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
└── 📁E-Shop_DIGITIVA
    └── 📁ADMIN-PANEL
        ├── index.php
        ├── upload.php
    └── 📁CART
        ├── addToCart.php
        ├── index.php
    └── 📁CONFIG
        ├── config.php
        ├── db.php
    └── 📁CSS
        ├── admin.css
        ├── cart.css
        ├── dashboard.css
        ├── products.css
        ├── register.css
        ├── signin.css
        ├── singleP.css
        ├── style.css
    └── 📁DASHBOARD
        ├── index.php
    └── 📁IMG
        └── 📁PFP
            ├── Default.jpg
        ├── arrow.png
        ├── background_cropped.jpg
        ├── background.jpg
        ├── burger.svg
        ├── cart.png
        ├── Digitiva-inverted.png
        ├── Digitiva.png
        ├── Digitiva2.png
        ├── eye.png
        ├── favicon.jpg
        ├── favicon.png
        ├── Gigabyte AORUS 5090.png
        ├── hidden.png
        ├── INNO3D-5090.png
        ├── logout.png
        ├── lupa.png
        ├── noImage.webp
        ├── X-Diablo Gamer.png
    └── 📁PRODUCTS
        ├── index.php
        ├── product.php
    ├── index.php
    ├── login.php
    ├── logout.php
    ├── README.md
    └── register.php
```

---

## Contributing

1. Fork this repository  
2. Create a new branch: `feature/yourFeature`  
3. Make your changes and commit  
4. Open a Pull Request

---


## Contact

For suggestions, questions, or contributions:

- Open an issue on GitHub
