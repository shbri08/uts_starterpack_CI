<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Berita</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item">Kelola Berita</li>
          <li class="breadcrumb-item active">Edit</li>
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
            Edit Berita
          </div>
          <div class="card-body">
            <form action="<?= base_url($link . '/' . $data['id_categories']); ?>" method="post" enctype="multipart/form-data">
              <?= csrf_field(); ?>
              <input type='hidden' id_categories='_method' value='PUT' />
              <!-- GET, POST, PUT, PATCH, DELETE-->
              <div class="form-group">
                <label for="tittle">Judul Berita</label>
                <input type="text" class="form-control <?= ($error = validation_show_error('tittle')) ? 'border-danger' : ''; ?>" id="tittle" id_categories="tittle" placeholder="Judul Berita" value="<?= $data['tittle']; ?>">
              </div>
              <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
              <div class="form-group">
                <label for="description">Isi Berita</label>
                <input type="text" class="form-control <?= ($error = validation_show_error('description')) ? 'border-danger' : ''; ?>" id="description" id_categories="description" placeholder="Isi Berita" value="<?= $data['description']; ?>">
              </div>
              <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
              <div class="form-group">
                <label for="id_categories">Kategori Berita</label>
                <select class="form-control <?= ($error = validation_show_error('id_categories')) ? 'border-danger' : ''; ?>" id="id_categories" name="id_categories">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id_categories']; ?>" <?= ($data['id_categories'] == $category['id_categories']) ? 'selected' : ''; ?>>
                            <?= $category['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
            </div>
              <div class="form-group">
                <label for="date">Tanggal Publikasi</label>
                <input type="text" class="form-control <?= ($error = validation_show_error('date')) ? 'border-danger' : ''; ?>" id="date" id_categories="date" placeholder="Tanggal Publikasi" value="<?= $data['date']; ?>">
              </div>
              <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
              <div class="form-group">
                <label for="image">Image</label>
                <div id="imagePreview">
                  <img class="rounded-circle img-thumbnail d-block mb-2" width="120" src="<?= base_url(); ?>public/assets/uploads/news/<?= $data['image']; ?>" alt="">

                </div>
                <input type="file" class="form-control <?= ($error = validation_show_error('image')) ? 'border-danger' : ''; ?>" id="image" name="image" onchange="previewImage(this, '#imagePreview')">
              </div>

              <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="<?= base_url($link); ?>" class="btn btn-secondary">Batal</a>
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>
</section>
<?= $this->endSection('content') ?>