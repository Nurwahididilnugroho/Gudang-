<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $stmt = $db->prepare("INSERT INTO items (name, quantity, description) VALUES (:name, :quantity, :description)");
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':quantity', $quantity, SQLITE3_INTEGER);
    $stmt->bindValue(':description', $description, SQLITE3_TEXT);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error: " . $db->lastErrorMsg();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <h1>Tambah Barang Baru</h1>
    <form method="POST" action="">
        <label for="name">Nama Barang:</label>
        <input type="text" name="name" required>
        
        <label for="quantity">Jumlah:</label>
        <input type="number" name="quantity" required>
        
        <label for="description">Deskripsi:</label>
        <textarea name="description"></textarea>
        
        <button type="submit">Tambah</button>
    </form>
    <a href="struktur.php" class="btn">Kembali</a>
</body>
</html>
