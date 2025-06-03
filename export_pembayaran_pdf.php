<?php
include 'koneksi.php';
require('assets/fpdf.php');

// Ambil data pembayaran
$query = mysqli_query($koneksi, "SELECT p.nim, m.nama, p.jumlah, p.tanggal, p.status 
                                 FROM pembayaran p 
                                 JOIN mahasiswa m ON p.nim = m.nim");

// Inisialisasi PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Laporan Pembayaran UKT Mahasiswa', 0, 1, 'C');
$pdf->Ln(5);

// Header tabel
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'No', 1);
$pdf->Cell(30, 10, 'NIM', 1);
$pdf->Cell(50, 10, 'Nama', 1);
$pdf->Cell(30, 10, 'Jumlah', 1);
$pdf->Cell(30, 10, 'Tanggal', 1);
$pdf->Cell(30, 10, 'Status', 1);
$pdf->Ln();

// Isi tabel
$pdf->SetFont('Arial', '', 10);
$no = 1;
$total = 0;
while ($data = mysqli_fetch_array($query)) {
    $pdf->Cell(10, 10, $no++, 1);
    $pdf->Cell(30, 10, $data['nim'], 1);
    $pdf->Cell(50, 10, $data['nama'], 1);
    $pdf->Cell(30, 10, 'Rp ' . number_format($data['jumlah'], 0, ',', '.'), 1);
    $pdf->Cell(30, 10, $data['tanggal'], 1);
    $pdf->Cell(30, 10, $data['status'], 1);
    $pdf->Ln();

    // Hitung total
    $total += $data['jumlah'];
}

// Total pembayaran
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(120, 10, 'TOTAL', 1);
$pdf->Cell(30, 10, 'Rp ' . number_format($total, 0, ',', '.'), 1);
$pdf->Cell(60, 10, '', 1);
$pdf->Ln();

$pdf->Output();
?>
