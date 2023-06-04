<!DOCTYPE html>
<html>
<head>
    <title>Reservasi Lapangan MiniSoccer</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="reactberhasil.js"></script>
</head>
<body>
    <h1>Reservasi Lapangan MiniSoccer</h1>
    <div id="root"></div>

    <?php
require_once 'penyewaanlapangan.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $jamMulai = $_POST['jam_mulai'];
    $jamSelesai = $_POST['jam_selesai'];
    $lapanganType = $_POST['lapangan']; // Menyimpan pilihan lapangan dari form

    $harga = 0; // Inisialisasi variabel harga

    // Menentukan harga berdasarkan pilihan lapangan
    if ($lapanganType == 'pertama') {
        $lapangan = new Lapangan('pertama', 80000);
        $harga = 80000;
    } elseif ($lapanganType == 'kedua') {
        $lapangan = new Lapangan('kedua', 120000);
        $harga = 120000;
    } elseif ($lapanganType == 'ketiga') {
        $lapangan = new Lapangan('ketiga', 160000);
        $harga = 160000;
    }
    if ($lapangan->cekWaktu($tanggal, $jamMulai, $jamSelesai)) {
        header("Location: pemesanan-gagal.php");
        exit();
    } else {
        $lapangan->pesanLapangan($nama, $tanggal, $jamMulai, $jamSelesai);
        $durasi = $lapangan->hitungDurasi($jamMulai, $jamSelesai);
        $hargaTotal = $harga * $durasi; // Menghitung harga total berdasarkan durasi
        header("Location: pemesanan.php?nama=$nama&tanggal=$tanggal&jam_mulai=$jamMulai&jam_selesai=$jamSelesai&durasi=$durasi&harga=$hargaTotal&lapangan=$lapanganType"); // Menambahkan nilai lapangan ke URL pengalihan
        exit();
    }
}
?>



<form method="POST" action="index.php" onsubmit="return validateForm()">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" required><br>

    <label for="tanggal">Tanggal:</label>
    <input type="date" name="tanggal" required><br>

    <label for="jam_mulai">Jam Mulai:</label>
    <input type="time" name="jam_mulai" required><br>

    <label for="jam_selesai">Jam Selesai:</label>
    <input type="time" name="jam_selesai" required><br>

    <label for="lapangan">Lapangan:</label>
    <select name="lapangan" required>
        <option value="">pilihan</option>
        <option value="pertama">Lapangan 1</option>
        <option value="kedua">Lapangan 2</option>
        <option value="ketiga">Lapangan 3</option>
    </select><br>

    <input type="submit" name="submit" value="Pesan">
</form>
<div>
    <h5>Check Type Lapangan</h5>
    <a href="checklapangan.php" class="lapangan">check</a>
</div>
</body>
</html>
