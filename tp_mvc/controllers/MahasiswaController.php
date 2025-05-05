<?php

class MahasiswaController {
    private $mahasiswaModel;
    private $prodiModel;
    private $matkulModel;
    private $matkulMahasiswaModel;

    public function __construct($db) {
        $this->mahasiswaModel = new Mahasiswa($db);
        $this->prodiModel = new Prodi($db);
        $this->matkulModel = new Matkul($db);
        $this->matkulMahasiswaModel = new MatkulMahasiswa($db);
    }

    public function index() {
        $mahasiswa = $this->mahasiswaModel->getAll();
        require_once 'views/mahasiswa/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->mahasiswaModel->nama = $_POST['nama'];
            $this->mahasiswaModel->nim = $_POST['nim'];
            $this->mahasiswaModel->telepon = $_POST['telepon'];
            $this->mahasiswaModel->tanggal_masuk = $_POST['tanggal_masuk'];
            $this->mahasiswaModel->id_prodi = $_POST['id_prodi'];

            if ($this->mahasiswaModel->create()) {
                header('Location: index.php?controller=mahasiswa&action=index');
            }
        }
        $prodi = $this->prodiModel->getAll();
        require_once 'views/mahasiswa/create.php';
    }

    public function edit() {
        $id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->mahasiswaModel->id = $id;
            $this->mahasiswaModel->nama = $_POST['nama'];
            $this->mahasiswaModel->nim = $_POST['nim'];
            $this->mahasiswaModel->telepon = $_POST['telepon'];
            $this->mahasiswaModel->tanggal_masuk = $_POST['tanggal_masuk'];
            $this->mahasiswaModel->id_prodi = $_POST['id_prodi'];

            if ($this->mahasiswaModel->update()) {
                header('Location: index.php?controller=mahasiswa&action=index');
            }
        }

        $mahasiswa = $this->mahasiswaModel->getById($id);
        $prodi = $this->prodiModel->getAll();
        require_once 'views/mahasiswa/edit.php';
    }

    public function delete() {
        $id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan');
        
        // Delete enrolled courses first
        $this->matkulMahasiswaModel->unenrollAll($id);
        
        // Then delete the student
        if ($this->mahasiswaModel->delete($id)) {
            header('Location: index.php?controller=mahasiswa&action=index');
        }
    }

    public function viewMatkul() {
        $id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan');
        
        $mahasiswa = $this->mahasiswaModel->getById($id);
        $enrolled_matkul = $this->matkulMahasiswaModel->getMatkulByMahasiswa($id);
        $available_matkul = $this->matkulModel->getAll();
        
        require_once 'views/mahasiswa/matkul.php';
    }

    public function enrollMatkul() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->matkulMahasiswaModel->id_mahasiswa = $_POST['id_mahasiswa'];
            $this->matkulMahasiswaModel->id_matkul = $_POST['id_matkul'];
            $this->matkulMahasiswaModel->nilai = $_POST['nilai'] ?? null;

            if ($this->matkulMahasiswaModel->enroll()) {
                header('Location: index.php?controller=mahasiswa&action=viewMatkul&id=' . $_POST['id_mahasiswa']);
            }
        }
    }

    public function unenrollMatkul() {
        $id_mahasiswa = isset($_GET['id_mahasiswa']) ? $_GET['id_mahasiswa'] : die('ID Mahasiswa tidak ditemukan');
        $id_matkul = isset($_GET['id_matkul']) ? $_GET['id_matkul'] : die('ID Matkul tidak ditemukan');
        
        if ($this->matkulMahasiswaModel->unenroll($id_mahasiswa, $id_matkul)) {
            header('Location: index.php?controller=mahasiswa&action=viewMatkul&id=' . $id_mahasiswa);
        }
    }
}