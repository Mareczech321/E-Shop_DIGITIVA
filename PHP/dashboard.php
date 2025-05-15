<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digitiva</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="shortcut icon" href="../IMG/favicon.png" type="image/x-icon">
</head>
<body>
    <nav>
        <button id="burger_menu"></button>

        <a href="http://marekmulac.wz.cz:8080"><img src="../IMG/Digitiva2.png" id="logo"></a>

        <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>

        <a href="./logout.php"><img src="../IMG/logout.png" id="logout"></a>
    </nav>
    <article>
        
    </article>
</body>
</html>