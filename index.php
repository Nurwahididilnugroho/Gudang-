<?php
include 'db.php';

// Mengambil data barang dari database
$result = $db->query("SELECT * FROM items");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Gudang</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <h1>Data Barang di Gudang</h1>
    <a href="add.php" class="btn">Tambah Barang</a>
    <a href="struktur.php" class="btn">struktur</a>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php $db->close(); ?>
