<!DOCTYPE html>
<html>
<head>
    <title>Mata Kuliah Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/tp_mvc/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/tp_mvc/public/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/tp_mvc/views/layouts/navbar.php'; ?>

    <div class="container my-4">
        <h2>Mata Kuliah - <?= $mahasiswa['nama'] ?></h2>
        
        <div class="row mt-4">
            <div class="col-md-8">
                <h4>Mata Kuliah yang Diambil</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>SKS</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $enrolled_matkul->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?= $row['kode'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['sks'] ?></td>
                            <td><?= $row['nilai'] ?: '-' ?></td>
                            <td>
                                <a class="btn btn-danger btn-sm" href="index.php?controller=mahasiswa&action=unenrollMatkul&id_mahasiswa=<?= $mahasiswa['id'] ?>&id_matkul=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <h4>Tambah Mata Kuliah</h4>
                <form method="post" action="index.php?controller=mahasiswa&action=enrollMatkul">
                    <input type="hidden" name="id_mahasiswa" value="<?= $mahasiswa['id'] ?>">
                    <div class="mb-3">
                        <label>Mata Kuliah</label>
                        <select name="id_matkul" class="form-control" required>
                            <?php while($row = $available_matkul->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['kode'] ?> - <?= $row['nama'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>

    <script src="/tp_mvc/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>