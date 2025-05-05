<?php
session_start();
// Load Database configuration
require_once 'config/Database.php';

// Load models
require_once 'models/Prodi.php';
require_once 'models/Matkul.php';
require_once 'models/Mahasiswa.php';
require_once 'models/MatkulMahasiswa.php';

// Load controllers
require_once 'controllers/ProdiController.php';
require_once 'controllers/MatkulController.php';
require_once 'controllers/MahasiswaController.php';

$database = new Database();
$db = $database->getConnection();
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'mahasiswa';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($controllerName) {
    case 'mahasiswa':
        $controller = new MahasiswaController($db);
        break;
    case 'prodi':
        $controller = new ProdiController($db);
        break;
    case 'matkul':
        $controller = new MatkulController($db);
        break;
    default:
        die("Controller '{$controllerName}' gaada.");
}

$controller->$action();