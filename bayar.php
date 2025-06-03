<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nim'])) {
    header("Location: index.php");
}

$nim = $_SESSION['nim'];

if (isset($_POST['bayar'])) {
    $jumlah = $_POST['jumlah'];
    $tanggal = date('Y-m-d');

    // Simpan ke riwayat pembayaran (dummy)
    mysqli_query($koneksi, "INSERT INTO pembayaran (nim, jumlah, tanggal, status) VALUES ('$nim', '$jumlah', '$tanggal', 'Lunas')");

    // Update status tagihan
    mysqli_query($koneksi, "UPDATE tagihan SET status='Lunas' WHERE nim='$nim'");

    echo "<script>alert('Pembayaran berhasil!'); window.location='dashboard.php';</script>";
}

// Ambil tagihan saat ini
$query = mysqli_query($koneksi, "SELECT * FROM tagihan WHERE nim='$nim'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran UKT</title>
</head>
<body>
    <h2>Pembayaran UKT</h2>
    <p>Total Tagihan: Rp <?= number_format($data['jumlah'], 0, ',', '.') ?></p>

    <form method="post">
        <input type="hidden" name="jumlah" value="<?= $data['jumlah'] ?>">
        <button type="submit" name="bayar">Bayar Sekarang (Dummy)</button>
    </form>

    <br>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
