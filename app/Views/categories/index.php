<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Kelola Kategori Berita</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item">Kelola Kategori Berita</li>
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
      <div class="col-12">
        <a href="<?= base_url($link . '/new'); ?>" class="btn btn-primary btn-sm mb-2">Tambah Data</a>
        <div class="card">
          <div class="card-header">
          Kelola Kategori Berita
          </div>
          <div class="card-body">
            <table class="table" id="table2">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kategori</th>
                  <th>Deskripsi Kategori</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 1;
                foreach ($categories as $d) : ?>
                  <tr>
                    <td><?= $a++; ?></td>
                    <td><?= $d['name']; ?></td>
                    <td><?= $d['description']; ?></td>
                    <td>
                      <a class="btn btn-warning btn-sm mb-2" href="<?= base_url($link . '/' . $d['id_categories'] . '/edit'); ?>">Edit</a>
                      <form class="d-inline" action='<?= base_url($link . '/' . $d['id_categories']); ?>' method='post' enctype='multipart/form-data'>
                        <?= csrf_field(); ?>
                        <input type='hidden' name='_method' value='DELETE' />
                        <!-- GET, POST, PUT, PATCH, DELETE-->
                        <button type='button' onclick='deleteTombol(this)' class='btn btn-sm mb-2 btn-danger'>Delete</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


  </div>
</section>
<?= $this->endSection('content') ?>