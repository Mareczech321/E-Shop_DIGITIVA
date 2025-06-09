<?php
    session_start();
    require_once '../CONFIG/db.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit;
    }

    if (!isset($_SESSION['user_id'])) {
        die("Nepřihlášený uživatel.");
    }

    $userId = $_SESSION['user_id'];
    $target_dir = "./USERS/";
    $uploadOk = 1;

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (isset($_POST["pfp"])) {
        $file = $_FILES["pfp_change"];
        $fileExtension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

        var_dump($file["name"]);
    var_dump($fileExtension);
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Povoleny jsou pouze obrázky (JPG, PNG, GIF).";
            $uploadOk = 0;
        }

        if ($file["size"] > 2 * 1024 * 1024) {
            echo "Soubor je příliš velký (max 2 MB).";
            $uploadOk = 0;
        }

        if ($uploadOk) {
            $target_file = $target_dir . $userId . "." . $fileExtension;

            if (move_uploaded_file($file["tmp_name"], $target_file)) {

                $stmt = $pdo->prepare("UPDATE users SET has_pfp = true WHERE id = ?");
                $stmt->execute([$userId]);

                header("Location: ../DASHBOARD/");
                exit;
            } else {
                echo "Chyba při ukládání souboru.";
            }
        } else {
            echo "Nahrávání bylo zrušeno.";
        }
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
        <a href="http://marekmulac.wz.cz:8080"><img src="../IMG/Digitiva2.png" id="logo"></a>

        <h2>Hello, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>

        <a href="../logout.php"><img src="../IMG/logout.png" id="logout"></a>
    </nav>
    <h2 id='title'>Dashboard</h2>
    <section id="dashboard">
        <h2>Account Management</h2>
        <form method="post" id='acc_management' enctype="multipart/form-data">
                <label for="name_change">Change your name: </label><input type="text" name="name_change" id="name_change">
            <br><label for="password_change">Change your email: </label><input type="password" name="password_change" id="password_change">
            <br><label for="email_change">Change your password: </label><input type="text" name="email_change" id="email_change">
            <br><label for="pfp_change">Select .jpg, .png, .gif file to upload: </label><input type="file" name="pfp_change" id="pfp_change">
            <input type="submit" name="pfp" id="pfp" value='Change Profile Picture' style='padding-right: 10px'>
        </form>
    </section>
</body>
</html>