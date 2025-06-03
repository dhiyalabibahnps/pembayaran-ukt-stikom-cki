<?php
include 'koneksi.php';

// Header untuk download file Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_pembayaran_ukt.xls");

// Query data pembayaran
$query = mysqli_query($koneksi, "SELECT p.nim, m.nama, p.jumlah, p.tanggal, p.status 
                                 FROM pembayaran p 
                                 JOIN mahasiswa m ON p.nim = m.nim");
?>

<h2>Laporan Pembayaran UKT</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama Mahasiswa</th>
        <th>Jumlah</th>
        <th>Tanggal</th>
        <th>Status</th>
    </tr>
    <?php
    $no = 1;
    while ($data = mysqli_fetch_array($query)) {
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $data['nim'] ?></td>
        <td><?= $data['nama'] ?></td>
        <td><?= $data['jumlah'] ?></td>
        <td><?= $data['tanggal'] ?></td>
        <td><?= $data['status'] ?></td>
    </tr>
    <?php } ?>
</table>
