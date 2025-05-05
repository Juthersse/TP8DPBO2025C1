<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mata Kuliah</title>
    <link href="/tp_mvc/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/tp_mvc/public/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/tp_mvc/views/layouts/navbar.php'; ?>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Daftar Mata Kuliah</h2>
            <a href="index.php?controller=matkul&action=create" class="btn btn-primary">Add New</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>NAMA</th>
                    <th>SKS</th>
                    <th>PROGRAM STUDI</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $matkul->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $row['kode'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['sks'] ?></td>
                    <td><?= $row['nama_prodi'] ?></td>
                    <td>
                        <a class="btn btn-success btn-sm btn-action" href="index.php?controller=matkul&action=edit&id=<?= $row['id'] ?>">Edit</a>
                        <a class="btn btn-danger btn-sm btn-action" href="index.php?controller=matkul&action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <?php if (isset($_SESSION['error'])): ?>
        <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= $_SESSION['error'] ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        });
        </script>
        <?php 
        unset($_SESSION['error']);
        endif; 
        ?>
    </div>

    <script src="/tp_mvc/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>