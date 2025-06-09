<?php
  session_start();
  include '../CONFIG/db.php';

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
  <link rel="stylesheet" href="../CSS/product.css" />
  <link rel="shortcut icon" href="../IMG/favicon.png" type="image/x-icon">
</head>
<body>
  <header class="header">
    <a href="http://marekmulac.wz.cz:8080" class="logo"></a>

    <form class="search" method="post">
      <input type="text" placeholder="  Search for products" id="search_bar" />
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

            echo '<a href="http://marekmulac.wz.cz:8080/DASHBOARD/"><img src="' . htmlspecialchars($profilePic) . '" alt="Profil" id="profile-pic" style="height:32px; width:32px; border-radius:50%; object-fit:cover;"></a>';
        } else {
            echo '<a href="../login.php" id="login">Login / Register</a>';
        }
      ?>
    </div>
  </header>

  <section class="hero">
    <div id="overlay">
      <h1>Your Trusted Partner in Computer Technology</h1>
      <p>Computers, components, repairs, and a professional approach</p>
    </div>
  </section>

  <h2 id="nabidka_nadpis">Popular Products</h2>

  <section class="products">
  <aside id="filtry">
    <h2 onclick="showFilters()">Filters <img src="../IMG/arrow.png" id='hide_filters'></h2><hr>
    <div id='filters_hidden'>
      <div>
          <a class="filtr"><p onclick="window.location.href = './PC_Components'">PC Components</p><img src="../IMG/arrow.png" class="rozbalit" id="PC_filtr" onclick="showPC()" ></a>
          <ul id="PC">
              <li><a href="./PC_Components/case_fans.php">Case fans</a></li>
              <li><a href="./PC_Components/cases.php">Cases</a></li>
              <li><a href="./PC_Components/coolers.php">CPU coolers</a></li>
              <li><a href="./PC_Components/cpus.php">CPUs</a></li>
              <li><a href="./PC_Components/graphics_cards.php">Graphics cards</a></li>
              <li><a href="./PC_Components/hdd.php">HDD</a></li>
              <li><a href="./PC_Components/ssd.php">SSD</a></li>
              <li><a href="./PC_Components/psu.php">PSU</a></li>
              <li><a href="./PC_Components/motherboards.php">Motherboards</a></li>
          </ul>
      </div>

      <div>
        <a class="filtr"><p onclick="window.location.href = './peripherals'">Peripherals</p><img src="../IMG/arrow.png" class="rozbalit" id="peripherals_filtr" onclick="showperipherals()" ></a>
          <ul id="peripherals">
              <li><a href="./peripherals/keyboards.php">Keyboards</a></li>
              <li><a href="./peripherals/mice.php">Mice</a></li>
              <li><a href="./peripherals/headsets.php">Headsets</a></li>
              <li><a href="./peripherals/headphones.php">Headphones</a></li>
          </ul>
      </div>

      <div>
        <a class="filtr"><p onclick="window.location.href = './monitors'">Monitors</p><img src="../IMG/arrow.png" class="rozbalit" id="monitors_filter"></a>
      </div>
      <div>
        <a class="filtr"><p onclick="window.location.href = './smartwatches'">Smartwatches</p><img src="../IMG/arrow.png" class="rozbalit" id="smartwatches_filter"></a>
      </div>
      <div>
        <a class="filtr"><p onclick="window.location.href = './tablets'">Tablets</p><img src="../IMG/arrow.png" class="rozbalit" id="tablets_filter"></a>
      </div>
      <div>
        <a class="filtr"><p onclick="window.location.href = './SHD'">Smart Home Devices</p><img src="../IMG/arrow.png" class="rozbalit" id="SHD_filter"></a>
      </div>
      <div>
        <a class="filtr"><p onclick="window.location.href = './networking'">Networking</p><img src="../IMG/arrow.png" class="rozbalit" id="networking_filter"></a>
      </div>
      <div>
        <a class="filtr"><p onclick="window.location.href = './storage'">Storage Devices</p><img src="../IMG/arrow.png" class="rozbalit" id="storage_filter"></a>
      </div>
      <div>
        <a class="filtr"><p onclick="window.location.href = './accessories'">Accessories</p><img src="../IMG/arrow.png" class="rozbalit" id="accessories_filter"></a>
      </div>
    </div>
  </aside>
  
    <div class="product-grid">
      <?php
      include '../CONFIG/db.php';

      $stmt = $pdo->query("SELECT name, price, img_url FROM products ORDER BY id");

      if ($stmt->rowCount() > 0) {
        foreach ($stmt as $row) {
          echo '<div class="product-card">';
          echo '<img src="../IMG/' . ($row['img_url']) . '" alt="' . ($row['name']) . '">';
          echo '<h2>' . ($row['name']) . '</h2>';
          echo '<p class="price">$' . number_format($row['price'], 2, ',', ' ') . '</p>';
          echo '<button class="do_Kosiku">Add to cart</button>';
          echo '</div>';
        }
      } else {
        echo '<p>No products available</p>';
      }
      ?>
    </div>
  </section>

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
  if (window.matchMedia("(max-width: 600px)").matches) {
    document.getElementById('filters_hidden').style.display = 'none'
  }

  function showFilters(){
    if (window.matchMedia("(max-width: 600px)").matches) {  
      if (document.getElementById('filters_hidden').style.display == 'none'){
        document.getElementById('filters_hidden').style.display = 'block'
        document.getElementById('hide_filters').style.transform = 'rotate(0deg)'
      }else{
        document.getElementById('filters_hidden').style.display = 'none'
        document.getElementById('hide_filters').style.transform = 'rotate(-90deg)'
      }
    }
  }

  document.getElementById('PC').style.display = 'none'
  document.getElementById('peripherals').style.display = 'none'

  function showPC(){  
    if (document.getElementById('PC').style.display == 'none'){

      document.getElementById('peripherals').style.display = 'none'
      document.getElementById('peripherals_filtr').style.transform = 'rotate(-90deg)'
      
      document.getElementById('monitors_filter').style.transform = 'rotate(-90deg)'

      document.getElementById('PC').style.display = 'block'
      document.getElementById('PC_filtr').style.transform = 'rotate(0deg)'
    }else{
      document.getElementById('PC').style.display = 'none'
      document.getElementById('PC_filtr').style.transform = 'rotate(-90deg)'
    }
  }

  function showperipherals(){  
    if (document.getElementById('peripherals').style.display == 'none'){
      
      document.getElementById('PC').style.display = 'none'
      document.getElementById('PC_filtr').style.transform = 'rotate(-90deg)'
      
      document.getElementById('monitors_filter').style.transform = 'rotate(-90deg)'

      document.getElementById('peripherals').style.display = 'block'
      document.getElementById('peripherals_filtr').style.transform = 'rotate(0deg)'
    }else{
      document.getElementById('peripherals').style.display = 'none'
      document.getElementById('peripherals_filtr').style.transform = 'rotate(-90deg)'
    }
  }
</script>