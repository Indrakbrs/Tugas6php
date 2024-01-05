<DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Belanja App</title>
            <link rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

            <style>
                body {
                padding: 20px;
                }
            </style>
        </head>
<body>
    <div class="container">
        <h2 class="mt-4">Form Belanja</h2>
        
    <?php

function getBarangByKode($kode) {
    $barangList = [
        'BRG001' => ['nama'=>'topi', 'harga' => 150001],
        'BRG002' => ['nama' => 'Tshirt', 'harga' => 96000],
        'BRG003' => ['nama' => 'Jeans', 'harga' => 320000],
    ];
    return isset($barangList[$kode])? $barangList[$kode] : null;
}

function hitungTotal($jumlah, $harga) {
    return $jumlah * $harga;
}

function hitungDiskon($total) {
    $diskonPersen = 0.05;
    $batasDiskon = 500000;

    return $total > $batasDiskon ? $total * $diskonPersen : 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kodeBarang = $_POST["kode_barang"];
    $jumlahBeli = $_POST["jumlah_beli"];

    $barang = getBarangByKode($kodeBarang);

    if ($barang) {
        $namaBarang = $barang['nama'];
        $hargaSatuan = $barang['harga'];

        $totalPerBarang = hitungTotal($jumlahBeli, $hargaSatuan);

        $diskon = hitungDiskon($totalPerBarang) ;

        $totalPembayaran = $totalPerBarang - $diskon;
    
        echo "<h3>Hasil Transaksi</h3>";
        echo "<p>Kode Barang: $kodeBarang</p>";
        echo "<p>Nama Barang: $namaBarang</p>";
        echo "<p>Jumlah Beli: $jumlahBeli</p>";
        echo "<p>Harga Satuan: Rp " . number_format($hargaSatuan, 0,',','.')."</p>";
        echo "<p>Total Per Barang: Rp " . number_format($totalPerBarang, 0,',','.')."</p>";
        echo "<p>Diskon: Rp " . number_format($diskon, 0,',','.')."</p>";
        echo "<p>Total Pembayaran: Rp " . number_format($totalPembayaran, 0,',','.')."</p>";

    } else {
        echo "<p>Barang dengan kode $kodeBarang tidak ditemukan.</p>";
    }
}
?>

<form method="post" action="<?php echo
htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mt-4">
            <div class="form-group">
                <label for="kode_barang">Kode Barang:</label>
                <input type="text" name="kode_barang" class="form-control" required>
            </div>
            <div class="form-groups">
                <label for="jumlah_beli">Jumlah Beli:</label>
                <input type="number" name="jumlah_beli" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Hitung</button>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
    </script>
</body>
</html>    