<?php

class MatkulMahasiswa {
    private $conn;
    private $table = 'matkul_mahasiswa';

    public $id_mahasiswa;
    public $id_matkul;
    public $nilai;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getByMatkul($id_matkul) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_matkul = :id_matkul";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id_matkul' => $id_matkul]);
        return $stmt;
    }

    public function getMatkulByMahasiswa($id_mahasiswa) {
        $query = "SELECT m.*, mm.nilai 
                 FROM matkul m
                 JOIN matkul_mahasiswa mm ON m.id = mm.id_matkul
                 WHERE mm.id_mahasiswa = :id_mahasiswa";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id_mahasiswa' => $id_mahasiswa]);
        return $stmt;
    }

    public function enroll() {
        $query = "INSERT INTO " . $this->table . "
                 (id_mahasiswa, id_matkul, nilai)
                 VALUES (:id_mahasiswa, :id_matkul, :nilai)";
        
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            ':id_mahasiswa' => $this->id_mahasiswa,
            ':id_matkul' => $this->id_matkul,
            ':nilai' => $this->nilai
        ]);
    }

    public function updateNilai() {
        $query = "UPDATE " . $this->table . "
                 SET nilai = :nilai
                 WHERE id_mahasiswa = :id_mahasiswa 
                 AND id_matkul = :id_matkul";
        
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            ':id_mahasiswa' => $this->id_mahasiswa,
            ':id_matkul' => $this->id_matkul,
            ':nilai' => $this->nilai
        ]);
    }

    public function unenroll($id_mahasiswa, $id_matkul) {
        $query = "DELETE FROM " . $this->table . " 
                 WHERE id_mahasiswa = :id_mahasiswa 
                 AND id_matkul = :id_matkul";
                 
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':id_mahasiswa' => $id_mahasiswa,
            ':id_matkul' => $id_matkul
        ]);
    }

    public function unenrollAll($id_mahasiswa) {
        $query = "DELETE FROM " . $this->table . " WHERE id_mahasiswa = :id_mahasiswa";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id_mahasiswa' => $id_mahasiswa]);
    }
}