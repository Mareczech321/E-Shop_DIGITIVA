<?php
  session_start();
  include './CONFIG/db.php';

  if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("SELECT has_pfp FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $row = $stmt->fetch();

  if ($row) {
    $_SESSION['has_pfp'] = (bool)$row['has_pfp'];
  }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Digitiva</title>
  <link rel="stylesheet" href="./CSS/styles.css" />
  <link rel="shortcut icon" href="./IMG/favicon.png" type="image/x-icon">
</head>
<body>
  <header class="header">
    <a href="http://marekmulac.wz.cz:8080" class="logo"></a>

    <nav id="navigace">
      <a href="./PRODUCTS/computers.php">Computers</a>
      <a href="./PRODUCTS/notebooks.php">Notebooks</a>
    </nav>

    <form class="search">
      <input type="text" placeholder="  Search for products" id="search_bar" name="query" minlenght='3'>
      <input type="submit" id="search" value="Search">
    </form>
    <div class="nav-links">
      <a href="./CART/"><img src="./IMG/cart.png" alt="" id="cart"></a>
      <?php
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            $hasProfilePic = !empty($_SESSION['has_pfp']);

            if ($hasProfilePic) {
                $jpgPath = "./DASHBOARD/USERS/".$userId.".jpg";
                $pngPath = "./DASHBOARD/USERS/".$userId.".png";
                $gifPath = "./DASHBOARD/USERS/".$userId.".gif";

                if (file_exists($jpgPath)) {
                    $profilePic = $jpgPath;
                } elseif (file_exists($pngPath)) {
                    $profilePic = $pngPath;
                } elseif (file_exists($gifPath)) {
                    $profilePic = $gifPath;
                } else {
                    $profilePic = "./IMG/PFP/Default.jpg";
                }
            } else {
                $profilePic = "./IMG/PFP/Default.jpg";
            }

            echo '<a href="http://marekmulac.wz.cz:8080/DASHBOARD/"><img src="' . htmlspecialchars($profilePic) . '" alt="Profil" id="profile-pic" style="height:32px; width:32px; border-radius:50%; object-fit:cover;"></a>';
        } else {
            echo '<a href="./login.php" id="login">Login / Register</a>';
        }
      ?>
    </div>
  </header>

  <nav id="subnav">
    <a href="./PRODUCTS/computers.php">Computers</a>
    <a href="./PRODUCTS/notebooks.php">Notebooks</a>
  </nav>

  <section class="hero">
    <div id="overlay">
      <h1>Your Trusted Partner in Computer Technology</h1>
      <p>Computers, components, repairs, and a professional approach</p>
      <a href="./PRODUCTS/" class="cta-button">Browse Our Products</a>
    </div>
  </section>

  <h2 id="nabidky">
  <?php
    if (isset($_GET['query']) && trim($_GET['query']) !== '') {
        echo 'Search results for "<em>' . htmlspecialchars($_GET['query']) . '</em>"';
    } else {
        echo 'Popular Products';
    }
  ?>
</h2>

  <section class="products">
    <?php
      include './CONFIG/db.php';

      if (isset($_GET['query']) && strlen(trim($_GET['query'])) >= 3) {
          $searchQuery = trim($_GET['query']);
          $stmt = $pdo->prepare("SELECT name, price, img_url FROM products WHERE name LIKE :query");
          $stmt->execute([':query' => '%' . $searchQuery . '%']);
          $products = $stmt->fetchAll();

          if ($products) {
              foreach ($products as $product) {
                  echo '<div class="product-card">';
                  echo '<img src="' . htmlspecialchars($product["img_url"]) . '" alt="' . htmlspecialchars($product["name"]) . '" />';
                  echo '<h2>' . htmlspecialchars($product["name"]) . '</h2>';
                  echo '<p class="price">$' . number_format($product["price"], 2) . '</p>';
                  echo '<button>Add to cart</button>';
                  echo '</div>';
              }
          } else {
              echo '<h2>No products found for "<em>' . htmlspecialchars($searchQuery) . '</em>".</h2>';
          }
      } else if(isset($_GET['query']) && strlen(trim($_GET['query'])) < 3){
        echo '<h2>Please enter at least 3 characters to search.</h2>';
      } else {
    ?>
      <div class="product-card">
        <img src="./IMG/Gigabyte AORUS 5090.png" alt="Produkt 1" />
        <h2>Gigabyte AORUS RTX 5090 XTREME WATERFORCE</h2>
        <p class="price">$3,369.65</p>
        <button>Add to cart</button>
      </div>
      <div class="product-card">
        <img src="./IMG/INNO3D-5090.png" alt="Produkt 2" />
        <h2>Inno3D NVIDIA RTX 5090 X3 32GB GDDR7</h2>
        <p class="price">$2,864.78</p>
        <button>Add to cart</button>
      </div>
      <div class="product-card">
        <img src="./IMG/X-Diablo Gamer.png" alt="Produkt 3" />
        <h2>X-Diablo Gamer G711 3070</h2>
        <p class="price">$1,738.69</p>
        <button>Add to cart</button>
      </div>
    <?php } ?>
  </section>

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
  const navbar = document.getElementById('subnav');
  let scrollTimeout;

  window.addEventListener('scroll', function () {
    navbar.style.top = '-35px';
    
    clearTimeout(scrollTimeout);

    scrollTimeout = setTimeout(() => {
      navbar.style.top = '80px';
    }, 100);
});
</script>