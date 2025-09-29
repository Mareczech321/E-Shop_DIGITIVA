<?php
    session_start();
    include '../CONFIG/db.php';

    header('Content-Type: application/json; charset=utf-8');

    $response = ['success' => false, 'message' => 'Neznámá chyba'];

    if (!isset($_SESSION['user_id'])) {
        $response['message'] = 'Musíte být přihlášený.';
        echo json_encode($response);
        exit;
    }

    if (!isset($_POST['product_id'])) {
        $response['message'] = 'Produkt nebyl nalezen.';
        echo json_encode($response);
        exit;
    }

    $userId = $_SESSION['user_id'];
    $productId = intval($_POST['product_id']);

    try {
        $check = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
        $check->execute([$userId, $productId]);
        $existing = $check->fetch();

        if ($existing) {
            $update = $pdo->prepare("UPDATE cart SET quantity = quantity + 1 WHERE id = ?");
            $update->execute([$existing['id']]);
        } else {
            $insert = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)");
            $insert->execute([$userId, $productId]);
        }

        $response['success'] = true;
        $response['message'] = 'Produkt byl přidán do košíku.';

    } catch (Exception $e) {
        $response['message'] = 'Chyba databáze: ' . $e->getMessage();
    }

    echo json_encode($response);
    exit;
?>