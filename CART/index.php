<?php
session_start();
include '../CONFIG/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$userId = $_SESSION['user_id'];

// mazání z košíku
if (isset($_POST['remove'])) {
    $cartId = intval($_POST['cart_id']);
    $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->execute([$cartId, $userId]);
}

// aktualizace množství
if (isset($_POST['update'])) {
    $cartId = intval($_POST['cart_id']);
    $qty = max(1, intval($_POST['quantity']));
    $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$qty, $cartId, $userId]);
}

// načteme položky
$stmt = $pdo->prepare("
    SELECT c.id AS cart_id, c.quantity, p.name, p.price, p.img_url
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ?
");
$stmt->execute([$userId]);
$items = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <title>Váš košík | Digitiva</title>
  <link rel="stylesheet" href="../CSS/cart.css">
</head>
<body>
  <header class="header">
    <a href="../" class="logo"></a>
    <div class="nav-links">
      <a href="../PRODUCTS/" id="produkty">Produkty</a>
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

  <h2 id="kosik">Váš nákupní košík</h2>

  <section class="products">
    <?php if ($items): ?>
      <?php 
        $total = 0;
        foreach ($items as $item): 
          $subtotal = $item['price'] * $item['quantity'];
          $total += $subtotal;
      ?>
        <div class="product-card">
          <img src="../IMG/<?php if ($item['img_url'] == NULL) echo 'noImage.webp'; else echo htmlspecialchars($item['img_url']); ?>" 
               alt="<?php echo htmlspecialchars($item['name']); ?>">
          <h2><?php echo htmlspecialchars($item['name']); ?></h2>
          <p class="price">$<?php echo number_format($item['price'], 2, ',', ' '); ?></p>
          <form method="post" style="margin-top:10px;">
            <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" style="width:60px; text-align:center;">
            <button type="submit" name="update">Update</button>
            <button type="submit" name="remove" style="background:#f91e23;">Remove</button>
          </form>
          <p>Subtotal: $<?php echo number_format($subtotal, 2, ',', ' '); ?></p>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p style="margin:auto;">Košík je prázdný.</p>
    <?php endif; ?>
  </section>

  <?php if ($items): ?>
    <div style="text-align:center; margin:2rem;">
      <h2>Celkem: $<?php echo number_format($total, 2, ',', ' '); ?></h2>
      <a href="../checkout.php" class="cta-button">Pokračovat k objednávce</a>
    </div>
  <?php endif; ?>

  <footer class="footer" style="position:absolute; bottom:0; width:100%; text-align:center;">
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