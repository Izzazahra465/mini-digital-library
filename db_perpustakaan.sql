-- Database Mini Digital Library
CREATE DATABASE IF NOT EXISTS db_perpustakaan CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE db_perpustakaan;

DROP TABLE IF EXISTS buku;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL
);

CREATE TABLE buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    tahun_terbit YEAR NOT NULL,
    stok INT NOT NULL DEFAULT 1,
    sampul VARCHAR(255) DEFAULT NULL
);

-- Akun demo: username admin | password admin123 (bcrypt)
INSERT INTO users (username, password, nama_lengkap) VALUES
('admin', '$2b$12$6wFrTcLVTx3w.K2KhkVVPuD2pYQrNBlGWCyB0W1pYoS2kscayrpTq', 'Administrator');

INSERT INTO buku (judul, kategori, penulis, tahun_terbit, stok, sampul) VALUES
('Belajar PHP Dasar', 'Pemrograman', 'Budi Santoso', 2021, 3, NULL),
('Basis Data MySQL', 'Basis Data', 'Siti Aminah', 2020, 0, NULL);
