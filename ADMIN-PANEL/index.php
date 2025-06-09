<?php
    ini_set('session.cookie_path', '/');
    session_start();
    require '../CONFIG/db.php';

    if (!isset($_SESSION['user_id']) || empty($_SESSION['admin'])) {
      header("Location: ../login.php");
      exit;
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      if (isset($_POST['add'], $_POST['name'], $_POST['desc'], $_POST['quantity'], $_POST['price'], $_POST['category'], $_POST['subcategory'])){
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $subcategory = $_POST['subcategory'];

        if (empty($name) || empty($desc) || empty($quantity) || empty($price) || empty($category)) {
            $error = "Please fill in all fields.";
        }else{
          $stmt = $pdo->prepare("INSERT INTO products (name, description, quantity, price, category_id, subcategory_id) VALUES (?, ?, ?, ?, ?, ?);");
          $stmt->execute([$name, $desc, $quantity, $price, $category, $subcategory]);
        }
      }

      if (isset($_POST['edit_value'], $_POST['edit'], $_POST['id_edit'], $_POST['options'])) {
        $ID = $_POST['id_edit'];
        $value = $_POST['edit_value'];
        $option = $_POST['options'];

        $stmt = $pdo->prepare("UPDATE products SET ". $option ." = ? WHERE id = ?;");
        $stmt->execute([$value, $ID]);

        header("Location: ../ADMIN-PANEL/");
        exit;
      }

      if (isset($_POST['id_delete'], $_POST['delete'])){
        $ID = $_POST['id_delete'];

        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?;");
        $stmt->execute([$ID]);
      }

      header("Location: ../ADMIN-PANEL/");
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
  <link rel="shortcut icon" href="../IMG/favicon.png" type="image/x-icon">
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
      <a href="../logout.php" class="text-red-500 font-semibold">Logout</a>
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
        <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="addProduct()">Add Product</button>
        <button class="bg-yellow-500 text-white px-4 py-2 rounded" onclick="editProduct()">Edit Product</button>
        <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="deleteProduct()">Delete Product</button>
        <button class="bg-green-500 text-white px-4 py-2 rounded" onclick="importFile()">Bulk Import (Excel)</button><br>
        
        <form method="post" id="add_product">
          <label for="name">Name</label><input type="text" name="name" id="name" placeholder="Product name">
          <label for="desc">Description</label><input type="text" name="desc" id="desc" placeholder="Product description">
          <label for="quantity">Quantity</label><input type="number" name="quantity" id="quantity" placeholder="Product quantity">
          <br><label for="price">Price</label><input type="number" name="price" id="price" placeholder="Product price">
          <label for="category">Category</label><select name="category" id="category">
                                                  <option value="1">PC Components</option>
                                                  <option value="2">Peripherals</option>
                                                  <option value="3">Monitors</option>
                                                  <option value="4">Smartwatches</option>
                                                  <option value="5">Tablets</option>
                                                  <option value="6">Smart Home Devices</option>
                                                  <option value="7">Networking</option>
                                                  <option value="8">Storage Devices</option>
                                                  <option value="9">Accessories</option>
                                                </select>
          <label for="subcategory">Subcategory</label><select name="subcategory" id="subcategory">
                                                  <option value="1">CPUs</option>
                                                  <option value="2">GPUs</option>
                                                  <option value="3">Motherboards</option>
                                                  <option value="4">RAM</option>
                                                  <option value="5">SSDs</option>
                                                  <option value="6">CPU Coolers</option>
                                                  <option value="7">Case Fans</option>
                                                  <option value="8">PSU</option>
                                                  <option value="9">Cases</option>
                                                  <option value="10">Keyboards</option>
                                                  <option value="11">Mice</option>
                                                  <option value="12">Headsets</option>
                                                  <option value="13">Headphones</option>
                                                </select>
          <input class="send_request" type="submit" name="add" id="add" value="Add Product">
        </form>

        <form method="post" id="edit_product">
          <label for="id_edit">ID: </label><input type="number" name="id_edit" id="id_edit" placeholder="Product ID">
          <label for="options">Change: </label><select id="options" name="options">
                                                    <option value="name">Name</option>
                                                    <option value="description">Description</option>
                                                    <option value="quantity">Quantity</option>
                                                    <option value="price">Price</option>
                                                    <option value="category_id">Category ID</option>
                                                    <option value="subcategory_id">Subcategory ID</option>
                                                  </select>
          <label for="edit_value">To: </label><input type="text" name="edit_value" id="edit_value">
          <input class="send_request" type="submit" name="edit" id="edit" value="Edit Product">    
        </form>

        <form method="post" id="delete_product">
          <label for="id_delete">ID: </label><input type="number" name="id_delete" id="id_delete" placeholder="Product ID">
          <input class="send_request" type="submit" name="delete" id="delete" value="Delete Product">           
        </form>

        <form action="upload.php" method="post" enctype="multipart/form-data" id="import_file">
          <label for="upload">Select .txt file to upload: </label><input type="file" name="file_upload" id="file_upload">
          <input class="send_request" type="submit" name="file_submit" id="file_submit" value="Import">
        </form>

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
        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Edit Option</button>
        <button class="bg-red-500 text-white px-4 py-2 rounded">Remove Option</button>
      </div>
    </section>
  </main>
</body>
</html>
<script>
  document.getElementById('add_product').style.display = 'none'
  document.getElementById('edit_product').style.display = 'none'
  document.getElementById('delete_product').style.display = 'none'
  document.getElementById('import_file').style.display = 'none'

  function addProduct(){
    if (document.getElementById('add_product').style.display == 'none'){
      document.getElementById('delete_product').style.display = 'none'
      document.getElementById('edit_product').style.display = 'none'
      document.getElementById('import_file').style.display = 'none'
      document.getElementById('add_product').style.display = 'inline-block'
    }else{
      document.getElementById('add_product').style.display = 'none'
    }
  }
  function editProduct(){
    if (document.getElementById('edit_product').style.display == 'none'){
      document.getElementById('delete_product').style.display = 'none'
      document.getElementById('add_product').style.display = 'none'
      document.getElementById('import_file').style.display = 'none'
      document.getElementById('edit_product').style.display = 'inline-block'
    }else{
      document.getElementById('edit_product').style.display = 'none'
    }
  }
  function deleteProduct(){
    if (document.getElementById('delete_product').style.display == 'none'){
      document.getElementById('edit_product').style.display = 'none'
      document.getElementById('add_product').style.display = 'none'
      document.getElementById('import_file').style.display = 'none'
      document.getElementById('delete_product').style.display = 'inline-block'
    }else{
      document.getElementById('delete_product').style.display = 'none'
    }
  }
  function importFile(){
    if (document.getElementById('import_file').style.display == 'none'){
      document.getElementById('edit_product').style.display = 'none'
      document.getElementById('add_product').style.display = 'none'
      document.getElementById('delete_product').style.display = 'none'
      document.getElementById('import_file').style.display = 'inline-block'
    }else{
      document.getElementById('import_file').style.display = 'none'
    }
  }
</script>