<?php

class ProdiController {
    private $prodiModel;
    private $matkulModel;

    public function __construct($db) {
        $this->prodiModel = new Prodi($db);
        $this->matkulModel = new Matkul($db);
    }

    public function index() {
        $prodi = $this->prodiModel->getAll();
        require_once 'views/prodi/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->prodiModel->nama = $_POST['nama'];
            $this->prodiModel->kode = $_POST['kode'];
            $this->prodiModel->deskripsi = $_POST['deskripsi'];

            if ($this->prodiModel->create()) {
                header('Location: index.php?controller=prodi&action=index');
            }
        }
        require_once 'views/prodi/create.php';
    }

    public function edit() {
        $id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->prodiModel->id = $id;
            $this->prodiModel->nama = $_POST['nama'];
            $this->prodiModel->kode = $_POST['kode'];
            $this->prodiModel->deskripsi = $_POST['deskripsi'];

            if ($this->prodiModel->update()) {
                header('Location: index.php?controller=prodi&action=index');
            }
        }

        $prodi = $this->prodiModel->getById($id);
        require_once 'views/prodi/edit.php';
    }

    public function delete() {
        $id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan');
        
        if ($this->matkulModel->getByProdi($id)->rowCount() > 0) {
            $_SESSION['error'] = "Program Studi masih memiliki mata kuliah yang terdaftar.";
            header('Location: index.php?controller=prodi&action=index');
            exit;
        }
        
        if ($this->prodiModel->delete($id)) {
            header('Location: index.php?controller=prodi&action=index');
        }
    }
}