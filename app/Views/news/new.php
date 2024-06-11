<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tambah Data Isi Berita</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item">Kelola Isi Berita</li>
          <li class="breadcrumb-item active">Tambah data Isi Berita</li>
        </ol>
      </div>
      <!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-5">
        <div class="card">
          <div class="card-header">
            Tambah Data Isi Berita
          </div>
          <div class="card-body">
            <!-- Form Tambah Data Isi Berita -->
            <form action="<?= base_url($link); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="form-group">
                <label for="tittle">Judul Berita</label>
                <input type="text" class="form-control <?= ($error = validation_show_error('tittle')) ? 'border-danger' : ''; ?>" id="tittle" name="tittle" placeholder="Judul Berita" value="<?= old('tittle'); ?>">
            </div>
            <!-- Input untuk Isi Berita -->
            <div class="form-group">
                <label for="description">Isi Berita</label>
                <input type="text" class="form-control <?= ($error = validation_show_error('description')) ? 'border-danger' : ''; ?>" id="description" name="description" placeholder="Isi Berita" value="<?= old('description'); ?>">
            </div>
            <!-- Dropdown untuk Kategori Berita -->
            <div class="form-group">
                <label for="id_categories">Kategori Berita</label>
                <select class="form-control <?= ($error = validation_show_error('id_categories')) ? 'border-danger' : ''; ?>" id="id_categories" name="id_categories">
                <option value="">Pilih Kategori</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['id_categories']; ?>" <?= set_select('id_categories', $category['id_categories']); ?>><?= $category['name']; ?></option>
                <?php endforeach; ?>
                </select>
                <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
            </div>
            <!-- Input untuk Tanggal Publikasi -->
            <div class="form-group">
                <label for="date">Tanggal Publikasi</label>
                <input type="text" class="form-control <?= ($error = validation_show_error('date')) ? 'border-danger' : ''; ?>" id="date" name="date" title="date" placeholder="Tanggal Publikasi" value="<?= set_value('date'); ?>" readonly>
                <?php if ($error): ?>
                <div class="invalid-feedback"><?= $error ?></div>
                <?php endif; ?>
            </div>
            <!-- Input untuk Gambar -->
            <div class="form-group">
                <label for="image">Image</label>
                <div id="imagePreview">
                <img class="rounded-circle img-thumbnail d-block mb-2" width="120" src="<?= base_url(); ?>public/assets/uploads/news.png" alt="">
                </div>
                <input type="file" class="form-control <?= ($error = validation_show_error('image')) ? 'border-danger' : ''; ?>" id="image" title="image" onchange="previewImage(this, '#imagePreview')">
            </div>
            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="<?= base_url($link); ?>" class="btn btn-secondary">Batal</a>
            </form>

          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(function() {
            $("#date").datepicker({
                dateFormat: 'yy-mm-dd' // Format tanggal yang diinginkan
            });
        });
    </script>


  </div>
</section>
<?= $this->endSection('content') ?>