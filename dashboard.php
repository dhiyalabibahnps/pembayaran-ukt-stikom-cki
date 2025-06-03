<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nim'])) {
    header("Location: index.php");
}

$nim = $_SESSION['nim'];
$query = mysqli_query($koneksi, "SELECT * FROM tagihan WHERE nim='$nim'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <h3 class="mb-4">Halo, <?= $nim ?> 👋</h3>

        <div class="card shadow rounded-4 mb-4">
            <div class="card-body">
                <h5 class="card-title">Tagihan UKT Anda</h5>
                <p class="card-text display-6">Rp <?= number_format($data['jumlah'], 0, ',', '.') ?></p>
                <p>Status: <span class="badge bg-<?= ($data['status'] == 'Lunas') ? 'success' : 'warning' ?>"><?= $data['status'] ?></span>
                </p>
                <?= ($data['status'] == 'Lunas') ? '' : "<a href='bayar.php' class='btn btn-success'>Bayar Sekarang</a>" ?>
            </div>
        </div>

        <a href="riwayat.php" class="btn btn-outline-primary">Lihat Riwayat Pembayaran</a>
        <a href="bukti_pembayaran.php?id=<?= $data['id_tagihan'] ?>" class="btn btn-outline-secondary ms-2" target="_blank">Download Bukti</a>
        <a href="logout.php" class="btn btn-outline-danger ms-2">Logout</a>

    </div>

</body>

</html>