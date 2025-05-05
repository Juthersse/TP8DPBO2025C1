<!DOCTYPE html>
<html>
<head>
  <title>Edit Mata Kuliah</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/tp_mvc/public/css/bootstrap.min.css" rel="stylesheet">
  <link href="/tp_mvc/public/css/style.css" rel="stylesheet">
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/tp_mvc/views/layouts/navbar.php'; ?>

  <div class="col-lg-6 m-auto">
    <form method="post" action="index.php?controller=matkul&action=edit&id=<?= $matkul['id'] ?>">
      <br><br>
      <div class="card">
        <div class="card-header bg-warning">
          <h1 class="text-white text-center">Update Mata Kuliah</h1>
        </div><br>

        <input type="hidden" name="id" value="<?= $matkul['id'] ?>">

        <label> KODE: </label>
        <input type="text" name="kode" value="<?= $matkul['kode'] ?>" class="form-control" required> <br>

        <label> NAMA: </label>
        <input type="text" name="nama" value="<?= $matkul['nama'] ?>" class="form-control" required> <br>

        <label> SKS: </label>
        <input type="number" name="sks" value="<?= $matkul['sks'] ?>" class="form-control" required> <br>

        <label> PROGRAM STUDI: </label>
        <select name="id_prodi" class="form-control" required>
          <?php while($row = $prodi->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?= $row['id'] ?>" <?= $row['id'] == $matkul['id_prodi'] ? 'selected' : '' ?>>
              <?= $row['nama'] ?>
            </option>
          <?php endwhile; ?>
        </select><br>

        <button class="btn btn-success" type="submit">Submit</button><br>
        <a class="btn btn-info" href="index.php?controller=matkul">Cancel</a><br>
      </div>
    </form>
  </div>

  <script src="/tp_mvc/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>