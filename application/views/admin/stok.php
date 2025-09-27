<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 class="h3 mb-0 text-gray-800"><b><?= $title ?></b></h3>
	</div>
	<button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#add"><i class="fas fa-plus fa-sm"></i> Tambah</button>
	<?= $this->session->flashdata('pesan') ?>
	<div class="card shadow">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="dataTable">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">ID Stok</th>
							<th class="text-center">Nama Barang</th>
              <th class="text-center">Jenis Barang</th>
              <th class="text-center">Foto</th>
              <th class="text-center">Jumlah Stok</th>
              <th class="text-center">Tanggal Update</th>
							<th class="text-center">AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($stok as $value) : ?>
							<tr class = "text-center">
								<td class="text-center"><?= $no++ ?></td>
								<td><?= $value->id_stok ?></td>
								<td><?= $value->nm_barang ?></td>
                <td><?= $value->jenis_barang ?></td>
                <td>
                    <?php if(!empty($value->foto)): ?>
                      <a href="<?= base_url('assets/images/'.$value->foto) ?>" target="_blank">
                        <img src="<?= base_url('assets/images/'.$value->foto) ?>" alt="" style="height: 50px; width: 50px; object-fit: cover;">
                      </a>
                    <?php else: ?>
                      <span>Tidak ada foto</span>
                    <?php endif; ?>
                </td>
                <td><?= $value->jml_barang ?></td>
                <td><?= do_formal_date($value->tgl_update) ?></td>
								<td>
                  <button class="btn btn-sm btn-primary m-1" data-toggle="modal" data-target="#edit<?= $value->id_stok ?>"><i class="fas fa-edit fa-sm"></i></button>
                  <a class="btn btn-danger btn-sm m-1 hapus" href="<?= base_url('admin/stok/delete/'.$value->id_stok) ?>"><i class="fas fa-trash"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Stok</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span area-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('admin/stok/add') ?>" method="post" enctype="multipart/form-data">
        	<div class="form-group">
        		<label>Nama Barang</label>
        		<input type="text" name="nm_barang" id="nm_barang" class="form-control" required>
        	</div>
            <div class="form-group">
        		<label>Jenis Barang</label>
        		<input type="text" name="jenis_barang" id="jenis_barang" class="form-control" required>
        	</div>
            <div class="form-group">
                <label>Foto Barang</label>
        		<input type="file" name="foto" id="foto" class="form-control" required>
        	</div>
            <div class="form-group">
                <label>Jumlah Barang</label>
                <input type="number" name="jml_barang" id="jml_barang" class="form-control" required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php foreach ($stok as $value): ?>
<div class="modal fade" id="edit<?= $value->id_stok ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Stok</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span area-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('admin/stok/edit/' . $value->id_stok) ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nm_barang" id="nm_barang" class="form-control" value="<?= $value->nm_barang ?>" required>
          </div>
          <div class="form-group">
            <label>Jenis Barang</label>
            <input type="text" name="jenis_barang" id="jenis_barang" class="form-control" value="<?= $value->jenis_barang ?>" required>
          </div>
          <div class="form-group">
            <label>Foto</label><br>
            <?php if (!empty($value->foto)): ?>
              <img src="<?= base_url('assets/images/' . $value->foto) ?>" alt="Foto Profil" class="img-thumbnail mb-2" width="150">
            <?php endif; ?>
            <input type="file" name="foto" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
          </div>
          <div class="form-group">
            <label>Jumlah Barang</label>
            <input type="number" name="jml_barang" id="jml_barang" class="form-control" value="<?= $value->jml_barang ?>" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
        </form>
    </div>
  </div>
</div>
<?php endforeach; ?>

<script>
   document.querySelectorAll('.hapus').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah link agar tidak langsung dijalankan
            var url = this.getAttribute('href'); // Ambil URL dari atribut href
            Swal.fire({
                title: "Hapus Data?",
                text: "Data yang sudah dihapus tidak dapat dipulihkan kembali!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi, redirect ke URL penghapusan
                    window.location.href = url;
                }
            });
        });
    });
</script>