<?php

class Matkul {
    private $conn;
    private $table = 'matkul';

    public $id;
    public $kode;
    public $nama;
    public $sks;
    public $id_prodi;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT m.*, p.nama as nama_prodi 
                 FROM " . $this->table . " m
                 LEFT JOIN prodi p ON m.id_prodi = p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . "
                 (kode, nama, sks, id_prodi)
                 VALUES (:kode, :nama, :sks, :id_prodi)";
        
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            ':kode' => $this->kode,
            ':nama' => $this->nama,
            ':sks' => $this->sks,
            ':id_prodi' => $this->id_prodi
        ]);
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByProdi($id_prodi) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_prodi = :id_prodi";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id_prodi' => $id_prodi]);
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table . "
                 SET kode = :kode, nama = :nama, sks = :sks, id_prodi = :id_prodi
                 WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            ':id' => $this->id,
            ':kode' => $this->kode,
            ':nama' => $this->nama,
            ':sks' => $this->sks,
            ':id_prodi' => $this->id_prodi
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}