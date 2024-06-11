<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Kelola Isi Berita</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item">Kelola Isi Berita</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <a href="<?= base_url($link . '/new'); ?>" class="btn btn-primary btn-sm mb-2">Tambah Data</a>
        <div class="card">
          <div class="card-header">
            Kelola Isi Berita
          </div>
          <div class="card-body">
            <table class="table" id="table2">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul Berita</th>
                  <th>Isi Berita</th>
                  <th>Kategori</th>
                  <th>Tanggal Publikasi</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 1;
                
                foreach ($news as $d) : ?>
                  <tr>
                    <td><?= $a++; ?></td>
                    <td><?= $d['tittle']; ?></td>
                    <td><?= $d['description']; ?></td>
                    <td>
                        <?php foreach ($categories as $category) {
                            if ($category['id_categories'] == $d['id_categories']) {
                                echo $category['name'];
                                break;
                            }
                        } ?>
                    </td>
                    <td><?= $d['date']; ?></td>
                    <td>
                        <?php $image_path = base_url('public/assets/uploads/news/' . $d['image']);
                        if (file_exists($image_path)) {
                            echo '<img width="70" src="' . $image_path . '" alt="">';
                        } else {
                            echo 'Gambar tidak ditemukan';
                        }
                        ?>
                    </td>
                    <td>
                      <a class="btn btn-warning btn-sm mb-2" href="<?= base_url($link . '/' . $d['id_news'] . '/edit'); ?>">Edit</a>
                      <form class="d-inline" action='<?= base_url($link . '/' . $d['id_news']); ?>' method='post' enctype='multipart/form-data'>
                        <?= csrf_field(); ?>
                        <input type='hidden' name='_method' value='DELETE' />
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
