<?php
include 'db.php';

// Mengambil data barang dari database
$result = $db->query("SELECT * FROM items");
$items = [];

// Mengumpulkan semua item dalam array
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $items[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denah Laci Barang</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding: 20px;
            text-align: center;
            margin: 0;
            padding: 0;
            background-image: url('Background/bcgrnd.jpeg'); /* Ganti dengan nama gambar Anda */
            background-size: cover; /* Memastikan gambar menutupi seluruh area */
            background-position: center; /* Memusatkan gambar */
            background-repeat: no-repeat; /* Mencegah gambar diulang */
            color:white;
        }
        

        h1 {
            /* color: #333; */
            font-size: 36px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Flex container untuk tampilan berlapis */
        .flex-container-layered {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start; /* Menyusun item ke kiri */
            position: relative;
            margin: 0 auto;
            justify-content:center;
        }

        .drawer-layered {
            width: 220px; 
            height: 300px; /* Meningkatkan tinggi untuk menampung tiga konten */
            background-color: #ffffff; 
            border: 1px solid #dee2e6; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            margin: 10px; 
            transition: transform 0.3s ease, z-index 0.3s ease; 
            position: relative; /* Mengatur posisi relatif untuk efek tumpukan */
        }

        .drawer-layered:hover {
            transform: translateY(-10px); 
            z-index: 10; 
        }

        .drawer-content {
            padding: 10px; /* Padding untuk konten */
            height: 100%; 
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Membagi ruang antara konten */
            align-items: center; /* Mengatur agar konten berada di tengah horizontal */
        }

        .drawer-title {
            font-size: 18px; /* Ukuran font untuk judul laci */
            margin-bottom: 10px; /* Jarak antara judul dan konten */
            color: #007bff; /* Warna judul */
            font-weight: bold; /* Tebal untuk judul */
        }

        .content-grid {
            display: flex;
            flex-direction: column; /* Mengatur konten dalam kolom */
            justify-content: space-between; /* Mengatur jarak antara konten */
            width: 100%; /* Mengatur lebar grid */
        }

        .item-content {
            margin: 5px 0; /* Jarak antara elemen dalam konten */
            text-align: center; /* Memastikan teks berada di tengah */
        }

        .item-content h2 {
            font-size: 16px; 
            margin: 5px 0;
            color: #333;
            font-weight: 600;
        }

        .item-content p {
            margin: 3px 0; /* Mengurangi margin untuk deskripsi */
            font-size: 12px; 
            color: #555;
        }

        a {
            display: inline-block;
            margin-top: 20px; 
            padding: 10px 20px; 
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 25px;
            font-size: 14px; 
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .drawer-layered {
                width: 100%; 
                max-width: 220px; 
            }
        }
    </style>
</head>
<body>
    <h1>Isi Laci Gudang</h1>
    <a href="index.php">Kembali</a>

    <div class="flex-container-layered">
        <?php 
        // Menghitung jumlah item
        $totalItems = count($items);
        // Menghitung jumlah laci yang akan dibuat
        $drawersCount = ceil($totalItems / 3); // Tiga item per laci

        for ($i = 0; $i < $drawersCount; $i++): 
            // Menghitung indeks untuk item dalam laci
            $item1 = $items[$i * 3] ?? null; // Item pertama
            $item2 = $items[$i * 3 + 1] ?? null; // Item kedua
            $item3 = $items[$i * 3 + 2] ?? null; // Item ketiga
        ?>
            <div class="drawer-layered">
                <div class="drawer-content">
                    <div class="drawer-title">Laci <?php echo $i + 1; ?></div> <!-- Menambahkan label untuk laci -->
                    
                    <div class="content-grid">
                        <?php if ($item1): ?>
                        <div class="item-content">
                            <h2><?php echo htmlspecialchars($item1['name']); ?></h2>
                            <p><strong>Jumlah:</strong> <?php echo htmlspecialchars($item1['quantity']); ?></p>
                            <p><strong>Deskripsi:</strong> <?php echo htmlspecialchars($item1['description']); ?></p>
                        </div>
                        <?php endif; ?>

                        <?php if ($item2): ?>
                        <div class="item-content">
                            <h2><?php echo htmlspecialchars($item2['name']); ?></h2>
                            <p><strong>Jumlah:</strong> <?php echo htmlspecialchars($item2['quantity']); ?></p>
                            <p><strong>Deskripsi:</strong> <?php echo htmlspecialchars($item2['description']); ?></p>
                        </div>
                        <?php endif; ?>

                        <?php if ($item3): ?>
                        <div class="item-content">
                            <h2><?php echo htmlspecialchars($item3['name']); ?></h2>
                            <p><strong>Jumlah:</strong> <?php echo htmlspecialchars($item3['quantity']); ?></p>
                            <p><strong>Deskripsi:</strong> <?php echo htmlspecialchars($item3['description']); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    
</body>
</html>

<?php $db->close(); ?>
