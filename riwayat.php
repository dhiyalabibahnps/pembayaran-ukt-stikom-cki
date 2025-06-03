<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nim'])) {
    header("Location: index.php");
}

$nim = $_SESSION['nim'];
$query = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE nim='$nim' ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pembayaran</title>
</head>
<body>
    <h2>Riwayat Pembayaran UKT</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
        <?php
        $no = 1;
        while ($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data['tanggal'] ?></td>
            <td>Rp <?= number_format($data['jumlah'], 0, ',', '.') ?></td>
            <td><?= $data['status'] ?></td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
