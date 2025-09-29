<?php
session_start();
include '../CONFIG/db.php';

// pokud není v URL ID, přesměruj na index
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    die("Product not found.");
}

?>
<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($product['name']); ?> | Digitiva</title>
  <link rel="stylesheet" href="../CSS/products.css">
  <link rel="stylesheet" href="../CSS/singleProduct.css">
</head>
<body>
  <header class="header">
    <a href="../index.php" class="logo"></a>

    <nav id="navigace">
      <a href="../PRODUCTS/computers.php">Computers</a>
      <a href="../PRODUCTS/notebooks.php">Notebooks</a>
    </nav>

    <form class="search">
      <input type="text" placeholder="  Search for products" id="search_bar" name="query" minlenght='3'>
      <input type="submit" id="search" value="Search">
    </form>
    <div class="nav-links">
      <a href="../CART/"><img src="../IMG/cart.png" alt="" id="cart"></a>
      <?php
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            $hasProfilePic = !empty($_SESSION['has_pfp']);

            if ($hasProfilePic) {
                $jpgPath = "../DASHBOARD/USERS/".$userId.".jpg";
                $pngPath = "../DASHBOARD/USERS/".$userId.".png";
                $gifPath = "../DASHBOARD/USERS/".$userId.".gif";

                if (file_exists($jpgPath)) {
                    $profilePic = $jpgPath;
                } elseif (file_exists($pngPath)) {
                    $profilePic = $pngPath;
                } elseif (file_exists($gifPath)) {
                    $profilePic = $gifPath;
                } else {
                    $profilePic = "../IMG/PFP/Default.jpg";
                }
            } else {
                $profilePic = "../IMG/PFP/Default.jpg";
            }

            echo '<a href="../index.php"><img src="' . htmlspecialchars($profilePic) . '" alt="Profil" id="profile-pic" style="height:32px; width:32px; border-radius:50%; object-fit:cover;"></a>';
        } else {
            echo '<a href="../login.php" id="login">Login / Register</a>';
        }
      ?>
    </div>
  </header>

  <nav id="subnav">
    <a href="./PRODUCTS/computers.php">Computers</a>
    <a href="./PRODUCTS/notebooks.php">Notebooks</a>
  </nav>

  <main style="max-width: 1000px; margin: 2rem auto; padding: 1rem;">
    <h1><?php echo htmlspecialchars($product['name']); ?></h1>
    <img class="productImage" src="../IMG/<?php echo htmlspecialchars($product['img_url'] ?? 'noImage.webp'); ?>" 
         alt="<?php echo htmlspecialchars($product['name']); ?>" 
         style="max-width:300px; display:block; margin-bottom:1rem;">
    <div class="productInfo">
        <p class="price">$<?php echo number_format($product['price'], 2, ',', ' '); ?></p>
        <p><?php echo $product['description'] ?? "No description available."; ?></p>
        <button class="do_Kosiku" onclick="addToCart(<?php echo $id; ?>)">Add to cart</button>
        <p id="cart-message" style="color:green; margin-top:10px;"></p>
    </div>
  </main>

  <footer class="footer">
    <p>&copy; 2025 Digitiva.com – All right reserved</p>
    <div class="footer-links">
      <a href="#">Contact</a>
      <a href="#">Terms and Conditions</a>
      <a href="#">Return Policy</a>
      <a href="#">Personal Data Processing</a>
    </div>
  </footer>
</body>
</html>
<script>
function addToCart(productId) {
    fetch('../CART/addToCart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'product_id=' + encodeURIComponent(productId)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Server vrátil chybu " + response.status);
        }
        return response.text();
    })
    .then(text => {
        try {
            const data = JSON.parse(text);
            const msg = document.getElementById('cart-message');
            if (data.success) {
                msg.textContent = "✅ " + data.message;
                msg.style.color = "green";
            } else {
                msg.textContent = "❌ " + data.message;
                msg.style.color = "red";
            }
        } catch (e) {
            console.error("Neplatná JSON odpověď:", text);
        }
    })
    .catch(err => {
        console.error("Chyba fetch:", err);
    });
}
</script>
