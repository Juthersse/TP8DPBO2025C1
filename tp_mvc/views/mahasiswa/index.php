<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mahasiswa</title>
    <link href="/tp_mvc/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/tp_mvc/public/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/tp_mvc/views/layouts/navbar.php'; ?>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Daftar Mahasiswa</h2>
            <a href="index.php?controller=mahasiswa&action=create" class="btn btn-primary">Add New</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>NAMA</th>
                    <th>PROGRAM STUDI</th>
                    <th>TELEPON</th>
                    <th>TANGGAL MASUK</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $mahasiswa->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $row['nim'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['nama_prodi'] ?></td>
                    <td><?= $row['telepon'] ?></td>
                    <td><?= $row['tanggal_masuk'] ?></td>
                    <td>
                        <a class="btn btn-success btn-sm btn-action" href="index.php?controller=mahasiswa&action=edit&id=<?= $row['id'] ?>">Edit</a>
                        <a class="btn btn-info btn-sm btn-action" href="index.php?controller=mahasiswa&action=viewMatkul&id=<?= $row['id'] ?>">Mata Kuliah</a>
                        <a class="btn btn-danger btn-sm btn-action" href="index.php?controller=mahasiswa&action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="/tp_mvc/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>