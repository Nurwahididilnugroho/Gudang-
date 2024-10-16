<?php
include 'db.php';

$id = $_GET['id'];
$result = $db->querySingle("SELECT * FROM items WHERE id = $id", true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $stmt = $db->prepare("UPDATE items SET name = :name, quantity = :quantity, description = :description WHERE id = :id");
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':quantity', $quantity, SQLITE3_INTEGER);
    $stmt->bindValue(':description', $description, SQLITE3_TEXT);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

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
    <title>Edit Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Barang</h1>
    <form method="POST" action="">
        <label for="name">Nama Barang:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($result['name']); ?>" required>
        
        <label for="quantity">Jumlah:</label>
        <input type="number" name="quantity" value="<?php echo htmlspecialchars($result['quantity']); ?>" required>
        
        <label for="description">Deskripsi:</label>
        <textarea name="description"><?php echo htmlspecialchars($result['description']); ?></textarea>
        
        <button type="submit">Update</button>
    </form>
    <a href="index.php" class="btn">Kembali</a>
</body>
</html>
