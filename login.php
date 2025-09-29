<?php
    ini_set('session.cookie_path', '/');
    session_start();
    require './CONFIG/db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['ID'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['admin'] = $user['admin'];

                if($_SESSION['admin']){
                    header("Location: ./ADMIN-PANEL/");
                    exit;
                }
                header("Location: ./DASHBOARD/");
                exit;
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "Invalid username.";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digitiva - Login</title>
    <link rel="stylesheet" href="./CSS/signin.css">
    <link rel="shortcut icon" href="./IMG/favicon.png" type="image/x-icon">
</head>
<body>
    <article>
        <a href="./index.php"><img src="./IMG/Digitiva2.png" id="logo"></a>

        <form method="post" id="login_form">
            <label for="Username">Username</label><br><input type="text" name="username" placeholder="  Username"><br>
            <label for="Password">Password</label><br><input type="password" name="password" placeholder="  Password" id="password_input"><input type="checkbox" onclick="togglePassword()" id="show_password"><br>
            <input type="submit" name="submit" id="login_submit" value="Login">
        </form>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <footer id="registration">
            New User? <a href="./register.php" id="registration_link">Create account</a>
        </footer>
    </article>
</body>
</html>
<script>
    function togglePassword() {
        var x = document.getElementById("password_input");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>