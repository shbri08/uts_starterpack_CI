<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit <?= $title; ?></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item">Kelola <?= $title; ?></li>
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
            Edit <?= $title; ?>
          </div>
          <div class="card-body">
            <form action="<?= base_url($link . '/' . $data['id_categories']); ?>" method="post" enctype="multipart/form-data">
              <?= csrf_field(); ?>
              <input type='hidden' name='_method' value='PUT' />
              <!-- GET, POST, PUT, PATCH, DELETE-->
              <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input type="text" class="form-control <?= ($error = validation_show_error('name')) ? 'border-danger' : ''; ?>" id="name" name="name" placeholder="Kategori" value="<?= $data['name']; ?>">
              </div>
              <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
              <div class="form-group">
                <label for="description">Deskripsi Kategori</label>
                <input type="text" class="form-control <?= ($error = validation_show_error('description')) ? 'border-danger' : ''; ?>" id="description" name="description" placeholder="Deskripsi Kategori" value="<?= $data['description']; ?>">
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