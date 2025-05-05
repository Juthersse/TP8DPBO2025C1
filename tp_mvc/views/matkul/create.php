<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mata Kuliah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/tp_mvc/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/tp_mvc/public/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/tp_mvc/views/layouts/navbar.php'; ?>

    <div class="container">
        <div class="form-container">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white text-center mb-0">Create Mata Kuliah</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="index.php?controller=matkul&action=create">
                        <div class="mb-3">
                            <label class="form-label">KODE</label>
                            <input type="text" name="kode" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NAMA</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">SKS</label>
                            <input type="number" name="sks" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">PROGRAM STUDI</label>
                            <select name="id_prodi" class="form-control" required>
                                <?php while($row = $prodi->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-success" type="submit">Submit</button>
                            <a class="btn btn-secondary" href="index.php?controller=matkul">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="/tp_mvc/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>