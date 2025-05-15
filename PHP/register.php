<?php
session_start();
require '../CONFIG/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Use lowercase names to match form inputs
    $username = trim($_POST['username']);
    $email = trim($_POST['E-mail']);  // keep same as form
    $password = $_POST['password'];

    $errors = [];

    if (strlen($username) > 30) {
        $errors[] = "Username must be 30 characters or fewer.";
    }if (strlen($password) > 128) {
        $errors[] = "Password must be 128 characters or fewer.";
    }if (strlen($email) > 255) {
        $errors[] = "Email must be 255 characters or fewer.";
    }

    if (empty($errors)) {
    // Basic validation
        if (empty($username) || empty($email) || empty($password)) {
            $error = "Please fill in all fields.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } else {

            // Check if username or email exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            if ($stmt->fetch()) {
                $error = "Username or email already used.";
            } else {

                // Hash password and insert
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
                $stmt->execute([$username, $hashed_password, $email]);

                // Redirect after success
                header("Location: login.php");
                exit;
            }
            }
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Digitiva - Register</title>
    <link rel="stylesheet" href="../CSS/register.css" />
    <link rel="shortcut icon" href="../IMG/favicon.png" type="image/x-icon" />
</head>
<body>
    <article>
        <a href="http://marekmulac.wz.cz:8080"><img src="../IMG/Digitiva2.png" id="logo"></a>

        <form method="post" id="login_form">
            <label for="Username">Username</label><br>
            <input type="text" name="username" placeholder="  Username" maxlenght= 30 minlenght= 8><br>

            <label for="Password">Password</label><br>
            <input type="password" name="password" placeholder="  Password" id="password_input" maxlength= 128 minlength= 8>
            <input type="checkbox" onclick="togglePassword()" id="show_password"><br>

            <label for="E-mail">E-mail</label><br>
            <input type="text" name="E-mail" placeholder="  E-mail" maxlength= 255 minlength= 5><br>

            <input type="submit" name="submit" id="login_submit" value="Register">
        </form>

        <?php if (isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>

        <footer id="registration">
            Already have an account? <a href="./login.php" id="registration_link">Login</a>
        </footer>
    </article>

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
</body>
</html>