-- 1) Buat Database
CREATE DATABASE IF NOT EXISTS ukt_kampus;
USE ukt_kampus;

-- 2) Tabel Mahasiswa
CREATE TABLE IF NOT EXISTS mahasiswa (
    nim VARCHAR(15) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- 3) Tabel Tagihan
CREATE TABLE IF NOT EXISTS tagihan (
    id_tagihan INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(15),
    jumlah BIGINT NOT NULL,
    status ENUM('Belum Lunas', 'Lunas') DEFAULT 'Belum Lunas',
    FOREIGN KEY (nim) REFERENCES mahasiswa(nim)
);

-- 4) Tabel Pembayaran
CREATE TABLE IF NOT EXISTS pembayaran (
    id_pembayaran INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(15),
    tanggal DATE DEFAULT CURRENT_DATE,
    jumlah BIGINT NOT NULL,
    status ENUM('Lunas', 'Pending', 'Belum Lunas') DEFAULT 'Belum Lunas',
    FOREIGN KEY (nim) REFERENCES mahasiswa(nim)
);

-- 5) Tabel Admin
CREATE TABLE IF NOT EXISTS admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- 6) Insert Data Dummy Mahasiswa
INSERT INTO mahasiswa (nim, nama, password) VALUES 
('202310001', 'Budi Santoso', '$2y$10$HASHEDPASSWORD1'),
('202310002', 'Siti Aminah', '$2y$10$HASHEDPASSWORD2');

-- 7) Insert Data Dummy Admin
INSERT INTO admin (username, password) VALUES 
('admin', '$2y$10$HASHEDADMINPASSWORD');

-- 8) Insert Data Dummy Tagihan
INSERT INTO tagihan (nim, jumlah, status) VALUES
('202310001', 3000000, 'Belum Lunas'),
('202310002', 3500000, 'Lunas');


ALTER TABLE pembayaran ADD status VARCHAR(20) DEFAULT 'Belum Lunas';