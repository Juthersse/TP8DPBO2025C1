<!DOCTYPE html>
<html>
<head>
  <title>Edit Mahasiswa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/tp_mvc/public/css/bootstrap.min.css" rel="stylesheet">
  <link href="/tp_mvc/public/css/style.css" rel="stylesheet">
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/tp_mvc/views/layouts/navbar.php'; ?>

  <div class="col-lg-6 m-auto">
    <form method="post" action="index.php?controller=mahasiswa&action=edit&id=<?= $mahasiswa['id'] ?>">
      <br><br>
      <div class="card">
        <div class="card-header bg-warning">
          <h1 class="text-white text-center">Update Mahasiswa</h1>
        </div><br>

        <input type="hidden" name="id" value="<?= $mahasiswa['id'] ?>">

        <label> NIM: </label>
        <input type="text" name="nim" value="<?= $mahasiswa['nim'] ?>" class="form-control" required> <br>

        <label> NAMA: </label>
        <input type="text" name="nama" value="<?= $mahasiswa['nama'] ?>" class="form-control" required> <br>

        <label> PROGRAM STUDI: </label>
        <select name="id_prodi" class="form-control" required>
          <?php while($row = $prodi->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?= $row['id'] ?>" <?= $row['id'] == $mahasiswa['id_prodi'] ? 'selected' : '' ?>>
              <?= $row['nama'] ?>
            </option>
          <?php endwhile; ?>
        </select><br>

        <label> TELEPON: </label>
        <input type="text" name="telepon" value="<?= $mahasiswa['telepon'] ?>" class="form-control" required> <br>

        <label> TANGGAL MASUK: </label>
        <input type="date" name="tanggal_masuk" value="<?= $mahasiswa['tanggal_masuk'] ?>" class="form-control" required> <br>

        <button class="btn btn-success" type="submit">Submit</button><br>
        <a class="btn btn-info" href="index.php?controller=mahasiswa">Cancel</a><br>
      </div>
    </form>
  </div>

  <script src="/tp_mvc/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>