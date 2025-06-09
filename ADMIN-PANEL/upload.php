<?php
    require '../CONFIG/db.php';

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
    $uploadOk = 1;
    $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if form was submitted
    if(isset($_POST["file_submit"])) {

        // Check file extension
        if($fileExtension != "txt") {
            echo "Sorry, only TXT files are allowed.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size (e.g., 500 KB limit)
        if ($_FILES["file_upload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Attempt to upload file if no errors
        if ($uploadOk == 0) {
            echo " Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["file_upload"]["name"])). " has been uploaded.";
            } else {
            echo "Sorry, there was an error uploading your file.";
            }
        }

        try {
            $file = file($target_file);
            $file2D = []; // Important: initialize this!

            foreach ($file as $value) {
                $row = explode('|', trim($value));
                if (count($row) == 6) {
                    $stmt = $pdo->prepare("INSERT INTO products (name, description, quantity, price, category_id, subcategory_id) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$row[0], $row[1], $row[2], $row[3], trim($row[4]) + 1, trim($row[5]) + 1]);
                } elseif (count($row) == 5) {
                    $stmt = $pdo->prepare("INSERT INTO products (name, description, quantity, price, category_id, subcategory_id) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$row[0], $row[1], $row[2], $row[3], trim($row[4]) + 1, null]);
                } else {
                    echo "Skipping invalid row: " . htmlspecialchars($value) . "<br>";
                }
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            exit;
        }
        header("Location: http://marekmulac.wz.cz:8080/ADMIN-PANEL/");
        exit;
    }
    
?>