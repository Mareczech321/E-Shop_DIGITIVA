<?php
    session_start();

    if (!isset($_SESSION['user_id']) || ($_SESSION['username'] != 'admin' && $_SESSION['username'] != 'owner') || ($_SESSION['user_id'] != 0 && $_SESSION['user_id'] != 1)) {
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Digitiva - Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="shortcut icon" href="../IMG/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>
  <header class="bg-white shadow p-4 flex justify-between items-center">
    <h2 class="text-2xl font-bold">Admin Panel</h2>
    <nav class="space-x-4">
      <a href="#dashboard" class="text-blue-600 hover:underline">Dashboard</a>
      <a href="#products" class="text-blue-600 hover:underline">Products</a>
      <a href="#reviews" class="text-blue-600 hover:underline">Reviews</a>
      <a href="#support" class="text-blue-600 hover:underline">Live Support</a>
      <a href="#qa" class="text-blue-600 hover:underline">Q&amp;A</a>
      <a href="#orders" class="text-blue-600 hover:underline">Orders</a>
      <a href="#payments" class="text-blue-600 hover:underline">Payments</a>
      <a href="#shipping" class="text-blue-600 hover:underline">Shipping &amp; Payment</a>
      <a href="logout.php" class="text-red-500 font-semibold">Logout</a>
    </nav>
  </header>

  <main class="p-6 space-y-8">
    <section id="dashboard" class="bg-white rounded-xl shadow p-6">
      <h2 class="text-xl font-semibold mb-4">Dashboard</h2>
      <ul class="space-y-2">
        <li>Today's Sales: $0.00</li>
        <li>Total Sales: $0.00</li>
        <li>Pending Orders: 0</li>
        <li>Best-Selling Products: N/A</li>
        <li>Low Stock Alerts</li>
        <li>Auto Enable/Disable Out-of-Stock Items</li>
      </ul>
    </section>

    <section id="products" class="bg-white rounded-xl shadow p-6">
      <h2 class="text-xl font-semibold mb-4">Manage Products</h2>
      <div class="space-x-2">
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Add Product</button>
        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Edit Product</button>
        <button class="bg-red-500 text-white px-4 py-2 rounded">Delete Product</button>
        <button class="bg-green-500 text-white px-4 py-2 rounded">Bulk Import (Excel)</button>
      </div>
    </section>

    <section id="reviews" class="bg-white rounded-xl shadow p-6">
      <h2 class="text-xl font-semibold mb-4">Review Management</h2>
      <p>Approve, delete, or respond to customer reviews.</p>
    </section>

    <section id="support" class="bg-white rounded-xl shadow p-6">
      <h2 class="text-xl font-semibold mb-4">Live Support</h2>
      <p>Chat interface or support ticket system.</p>
    </section>

    <section id="qa" class="bg-white rounded-xl shadow p-6">
      <h2 class="text-xl font-semibold mb-4">Q&amp;A</h2>
      <p>Manage customer questions and answers.</p>
    </section>

    <section id="orders" class="bg-white rounded-xl shadow p-6">
      <h2 class="text-xl font-semibold mb-4">Orders</h2>
      <p>View and manage all orders.</p>
    </section>

    <section id="payments" class="bg-white rounded-xl shadow p-6">
      <h2 class="text-xl font-semibold mb-4">Payment Logs</h2>
      <p>View all transactions and logs.</p>
    </section>

    <section id="shipping" class="bg-white rounded-xl shadow p-6">
      <h2 class="text-xl font-semibold mb-4">Shipping &amp; Payment Options</h2>
      <div class="space-x-2">
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Add Option</button>
        <button class="bg-red-500 text-white px-4 py-2 rounded">Remove Option</button>
        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Enable/Disable Option</button>
      </div>
    </section>
  </main>
</body>
</html>