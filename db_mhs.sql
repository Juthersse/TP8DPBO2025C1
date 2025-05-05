CREATE DATABASE IF NOT EXISTS db_mhs;
USE db_mhs;

CREATE TABLE prodi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kode VARCHAR(10) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    deskripsi TEXT
);

CREATE TABLE mahasiswa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(20) NOT NULL UNIQUE,
    telepon VARCHAR(15),
    tanggal_masuk DATE,
    id_prodi INT,
    FOREIGN KEY (id_prodi) REFERENCES prodi(id)
);

CREATE TABLE matkul (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kode VARCHAR(10) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    sks INT NOT NULL,
    id_prodi INT,
    FOREIGN KEY (id_prodi) REFERENCES prodi(id)
);

CREATE TABLE matkul_mahasiswa (
    id_mahasiswa INT,
    id_matkul INT,
    nilai CHAR(2),
    PRIMARY KEY (id_mahasiswa, id_matkul),
    FOREIGN KEY (id_mahasiswa) REFERENCES mahasiswa(id),
    FOREIGN KEY (id_matkul) REFERENCES matkul(id)
);