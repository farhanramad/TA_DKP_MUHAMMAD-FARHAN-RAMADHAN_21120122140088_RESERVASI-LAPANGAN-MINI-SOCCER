<!DOCTYPE html>
<html>
<head>
    <title>Pemesanan Berhasil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="reactberhasil.js"></script>
</head>
<body>
    <h1>Pemesanan Berhasil</h1>

    <?php
    $nama = $_GET['nama'];
    $tanggal = $_GET['tanggal'];
    $jamMulai = $_GET['jam_mulai'];
    $jamSelesai = $_GET['jam_selesai'];
    $durasi = $_GET['durasi'];
    $harga = $_GET['harga'];
    $lapanganType = $_GET['lapangan'];

    // Menampilkan informasi pemesanan
    echo "<p class='success'>Lapangan berhasil dipesan oleh $nama pada tanggal $tanggal dari jam $jamMulai sampai jam $jamSelesai.</p>";
    echo "<p class='harga'>Durasi: $durasi Jam</p>";

    // Menentukan harga berdasarkan jenis lapangan
    $jenisLapangan = $_GET['lapangan'];
    if ($jenisLapangan == 'pertama') {
        $hargaPerJam = 80000;
    } elseif ($jenisLapangan == 'kedua') {
        $hargaPerJam = 120000;
    } elseif ($jenisLapangan == 'ketiga') {
        $hargaPerJam = 160000;
    } else {
        $hargaPerJam = 0; // Harga default jika tidak ada jenis lapangan yang sesuai
    }

    $totalHarga = $hargaPerJam * $durasi;
    echo "<p class='lapangan'>lapangan: $lapanganType</p>";
    echo "<p class='harga'>Harga per jam: Rp $hargaPerJam</p>";
    echo "<p class='harga'>Total harga: Rp $totalHarga</p>";
    ?>

    <a href="index.php" onclick="return konfirmasiKembali();">Kembali</a>
</body>
</html>
