<?php

class Prodi {
    private $conn;
    private $table = 'prodi';

    public $id;
    public $nama;
    public $kode;
    public $deskripsi;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . "
                 (nama, kode, deskripsi)
                 VALUES (:nama, :kode, :deskripsi)";
        
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            ':nama' => $this->nama,
            ':kode' => $this->kode,
            ':deskripsi' => $this->deskripsi
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
                 SET nama = :nama, kode = :kode, deskripsi = :deskripsi
                 WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            ':id' => $this->id,
            ':nama' => $this->nama,
            ':kode' => $this->kode,
            ':deskripsi' => $this->deskripsi
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}