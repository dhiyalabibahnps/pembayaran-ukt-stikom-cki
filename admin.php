<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
}

$search = isset($_GET['search']) ?? $_GET['search'];

$query = mysqli_query($koneksi, "
    SELECT pembayaran.*, mahasiswa.nama 
    FROM pembayaran 
    JOIN mahasiswa ON pembayaran.nim = mahasiswa.nim 
    WHERE mahasiswa.nama LIKE '%$search%' OR pembayaran.nim LIKE '%$search%'
    ORDER BY pembayaran.tanggal DESC
");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="d-flex justify-content-between mb-4">
            <h3>Dashboard Admin 📊</h3>
            <a href="logout_admin.php" class="btn btn-danger">Logout Admin</a>
        </div>

        <form method="get" class="d-flex mb-3">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari NIM / Nama"
                value="<?= $search ?>">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>

        <a href="export_excel.php" class="btn btn-success mb-3">Export Excel</a>

        <h3>Export Laporan PDF Per Bulan</h3>
        <form method="get" action="export_pembayaran_pdf.php" target="_blank">
            Bulan:
            <select name="bulan">
                <?php for ($i = 1; $i <= 12; $i++) { ?>
                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= date('F', mktime(0, 0, 0, $i, 10)) ?>
                    </option>
                <?php } ?>
            </select>
            Tahun:
            <select name="tahun">
                <?php for ($t = 2023; $t <= date('Y'); $t++) { ?>
                    <option value="<?= $t ?>"><?= $t ?></option>
                <?php } ?>
            </select>
            <button type="submit">Export PDF</button>
        </form>
        <br><br>


        <div class="card shadow rounded-4">
            <div class="card-body">

                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td class="align-middle"><?= $no++ ?></td>
                                <td class="align-middle"><?= $data['nim'] ?></td>
                                <td class="align-middle"><?= $data['nama'] ?></td>
                                <td class="align-middle"><?= $data['tanggal'] ?></td>
                                <td class="align-middle">Rp <?= number_format($data['jumlah'], 0, ',', '.') ?></td>
                                <td class="align-middle"><span class="badge bg-success"><?= $data['status'] ?></span></td>
                                <td class="align-middle"><span class="d-flex justify-content-start gap-3"><a
                                            href="bukti_pembayaran.php?id=<?= $data['id_pembayaran'] ?>" target="_blank" class="btn btn-primary btn-sm">Download
                                            Bukti</a>
                                    </span></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br><br>
                <br><br>
                <a href="export_pembayaran.php" target="_blank">Export Laporan Pembayaran (Excel)</a> |
                <a href="export_pembayaran_pdf.php" target="_blank">Export Laporan Pembayaran (PDF)</a>
            </div>
        </div>

    </div>

</body>

</html>