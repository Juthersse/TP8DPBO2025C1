<?php

class MatkulController {
    private $matkulModel;
    private $prodiModel;
    private $matkulMahasiswaModel;

    public function __construct($db) {
        $this->matkulModel = new Matkul($db);
        $this->prodiModel = new Prodi($db);
        $this->matkulMahasiswaModel = new MatkulMahasiswa($db);
    }

    public function index() {
        $matkul = $this->matkulModel->getAll();
        require_once 'views/matkul/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->matkulModel->kode = $_POST['kode'];
            $this->matkulModel->nama = $_POST['nama'];
            $this->matkulModel->sks = $_POST['sks'];
            $this->matkulModel->id_prodi = $_POST['id_prodi'];

            if ($this->matkulModel->create()) {
                header('Location: index.php?controller=matkul&action=index');
            }
        }
        $prodi = $this->prodiModel->getAll();
        require_once 'views/matkul/create.php';
    }

    public function edit() {
        $id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->matkulModel->id = $id;
            $this->matkulModel->kode = $_POST['kode'];
            $this->matkulModel->nama = $_POST['nama'];
            $this->matkulModel->sks = $_POST['sks'];
            $this->matkulModel->id_prodi = $_POST['id_prodi'];

            if ($this->matkulModel->update()) {
                header('Location: index.php?controller=matkul&action=index');
            }
        }

        $matkul = $this->matkulModel->getById($id);
        $prodi = $this->prodiModel->getAll();
        require_once 'views/matkul/edit.php';
    }

    public function delete() {
        $id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan');
        
        $stmt = $this->matkulMahasiswaModel->getByMatkul($id);
        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = "Mata Kuliah tidak dapat dihapus karena masih ada mahasiswa yang terdaftar.";
            header('Location: index.php?controller=matkul&action=index');
            exit;
        }
        
        if ($this->matkulModel->delete($id)) {
            header('Location: index.php?controller=matkul&action=index');
        }
    }
}