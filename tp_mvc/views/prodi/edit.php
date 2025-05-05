<!DOCTYPE html>
<html>
<head>
  <title>Edit Program Studi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/tp_mvc/public/css/bootstrap.min.css" rel="stylesheet">
  <link href="/tp_mvc/public/css/style.css" rel="stylesheet">
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/tp_mvc/views/layouts/navbar.php'; ?>

  <div class="col-lg-6 m-auto">
    <form method="post" action="index.php?controller=prodi&action=edit&id=<?= $prodi['id'] ?>">
      <br><br>
      <div class="card">
        <div class="card-header bg-warning">
          <h1 class="text-white text-center">Update Program Studi</h1>
        </div><br>

        <input type="hidden" name="id" value="<?= $prodi['id'] ?>">

        <label> KODE: </label>
        <input type="text" name="kode" value="<?= $prodi['kode'] ?>" class="form-control" required> <br>

        <label> NAMA: </label>
        <input type="text" name="nama" value="<?= $prodi['nama'] ?>" class="form-control" required> <br>

        <label> DESKRIPSI: </label>
        <textarea name="deskripsi" class="form-control" rows="3"><?= $prodi['deskripsi'] ?></textarea><br>

        <button class="btn btn-success" type="submit">Submit</button><br>
        <a class="btn btn-info" href="index.php?controller=prodi">Cancel</a><br>
      </div>
    </form>
  </div>

  <script src="/tp_mvc/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>