<?php
include 'koneksi.php';
require('assets/fpdf.php');

$id = $_GET['id']; // ID pembayaran yang mau dicetak

// Ambil data pembayaran & mahasiswa
$query = mysqli_query($koneksi, "SELECT p.*, m.nama, m.prodi
                                 FROM pembayaran p 
                                 JOIN mahasiswa m ON p.nim = m.nim 
                                 WHERE p.id_pembayaran = '$id'");
$data = mysqli_fetch_array($query);

// Buat PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('logo_stikom.png', 10, 10, 30); // Logo kampus
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'BUKTI PEMBAYARAN UKT', 0, 1, 'C');
$pdf->Ln(20);

// Isi Data Mahasiswa
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Nama Mahasiswa', 0);
$pdf->Cell(5, 10, ':');
$pdf->Cell(100, 10, $data['nama'], 0, 1);

$pdf->Cell(50, 10, 'NIM', 0);
$pdf->Cell(5, 10, ':');
$pdf->Cell(100, 10, $data['nim'], 0, 1);

$pdf->Cell(50, 10, 'Program Studi', 0);
$pdf->Cell(5, 10, ':');
$pdf->Cell(100, 10, $data['prodi'], 0, 1);

// Info Pembayaran
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Detail Pembayaran', 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Jumlah Dibayar', 0);
$pdf->Cell(5, 10, ':');
$pdf->Cell(100, 10, 'Rp ' . number_format($data['jumlah'], 0, ',', '.'), 0, 1);

$pdf->Cell(50, 10, 'Tanggal Bayar', 0);
$pdf->Cell(5, 10, ':');
$pdf->Cell(100, 10, $data['tanggal'], 0, 1);

$pdf->Cell(50, 10, 'Status', 0);
$pdf->Cell(5, 10, ':');
$pdf->Cell(100, 10, $data['status'], 0, 1);

// Tanda tangan
$pdf->Ln(30);
$pdf->Cell(0, 10, 'Disahkan oleh:', 0, 1, 'R');
$pdf->Ln(20);
$pdf->Cell(0, 10, '_________________________', 0, 1, 'R');
$pdf->Cell(0, 10, 'Bagian Keuangan', 0, 1, 'R');


$nama_file = 'BuktiPembayaran_' . str_replace(' ', '_', $data['nama']) . '_' . $data['nim'] . '_' . date('Ymd', strtotime($data['tanggal'])) . '.pdf';

$pdf->Output('D', $nama_file);
?>
