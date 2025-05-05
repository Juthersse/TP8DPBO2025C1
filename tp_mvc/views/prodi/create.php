<!DOCTYPE html>
<html>
<head>
    <title>Tambah Program Studi</title>
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
                    <h3 class="text-white text-center mb-0">Create Program Studi</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="index.php?controller=prodi&action=create">
                        <div class="mb-3">
                            <label class="form-label">KODE</label>
                            <input type="text" name="kode" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NAMA</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">DESKRIPSI</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-success" type="submit">Submit</button>
                            <a class="btn btn-secondary" href="index.php?controller=prodi">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="/tp_mvc/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>