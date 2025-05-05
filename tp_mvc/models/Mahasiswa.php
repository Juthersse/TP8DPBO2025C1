<?php

class Mahasiswa {
    private $conn;
    private $table = 'mahasiswa';

    public $id;
    public $nama;
    public $nim;
    public $telepon;
    public $tanggal_masuk;
    public $id_prodi;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT s.*, p.nama as nama_prodi
                 FROM " . $this->table . " s
                 LEFT JOIN prodi p ON s.id_prodi = p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . "
                 (nama, nim, telepon, tanggal_masuk, id_prodi)
                 VALUES (:nama, :nim, :telepon, :tanggal_masuk, :id_prodi)";
        
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            ':nama' => $this->nama,
            ':nim' => $this->nim,
            ':telepon' => $this->telepon,
            ':tanggal_masuk' => $this->tanggal_masuk,
            ':id_prodi' => $this->id_prodi
        ]);
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table . "
                 SET nama = :nama, nim = :nim, telepon = :telepon, 
                     tanggal_masuk = :tanggal_masuk, id_prodi = :id_prodi
                 WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            ':id' => $this->id,
            ':nama' => $this->nama,
            ':nim' => $this->nim,
            ':telepon' => $this->telepon,
            ':tanggal_masuk' => $this->tanggal_masuk,
            ':id_prodi' => $this->id_prodi
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}