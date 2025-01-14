<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 class="h3 mb-0 text-gray-800"><b><?= $title?></b></h3>
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
							<th class="text-center">ID Barang<br>Masuk</th>
							<th class="text-center">Nama Karyawan</th>
              <th class="text-center">Nama Barang</th>
              <th class="text-center">Jumlah</th>
              <th class="text-center">Tanggal Masuk</th>
              <th class="text-center">Keterangan</th>
              <th class="text-center">Verifikasi Admin</th>
							<th class="text-center">AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($barang_masuk as $value) : ?>
							<tr class = "text-center">
								<td><?= $no++ ?></td>
								<td><?= $value->id_barang_masuk ?></td>
								<td><?= $value->nm_pengguna ?></td>
                <td><?= $value->nm_barang ?></td>
                <td><?= $value->jml_masuk ?></td>
                <td><?= do_formal_date($value->tgl_masuk) ?></td>
                <td><?= $value->keterangan ?></td>
                <td>
                  <?php if($value->verifikasi == NULL): ?>
                    <a class="badge badge-warning">Belum diverifikasi</a>
                  <?php elseif($value->verifikasi == 'sudah verifikasi'): ?>
                    <a class="badge badge-primary">Sudah diverifikasi</a>
                  <?php endif; ?>
                </td>
								<td>
                <?php if($value->verifikasi == NULL): ?>
                  <button class="btn btn-sm btn-primary m-1" data-toggle="modal" data-target="#edit<?= $value->id_barang_masuk ?>"><i class="fas fa-edit fa-sm"></i></button>
                  <a class="btn btn-danger btn-sm m-1 hapus" href="<?= base_url('karyawan/barang_masuk/delete/'.$value->id_barang_masuk) ?>"><i class="fas fa-trash"></i></a>
                <?php endif; ?>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang Masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span area-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('karyawan/barang_masuk/add') ?>" method="post" enctype="multipart/form-data">
        	<div class="form-group">
        		<label>Nama Barang</label>
                <select class="form-control" name="id_stok" id="id_stok">
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach($stok as $value): ?>
                    <option value="<?= $value->id_stok ?>"><?= $value->nm_barang ?></option>
                    <?php endforeach; ?>
                </select>
        	</div>
            <div class="form-group">
        		<label>Jumlah Barang Masuk</label>
        		<input type="number" name="jml_masuk" id="jml_masuk" class="form-control" required>
        	</div>
          <div class="form-group">
              <label>Keterangan</label>
              <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required></textarea>
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

<?php foreach ($barang_masuk as $value): ?>
<div class="modal fade" id="edit<?= $value->id_barang_masuk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Barang Masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('karyawan/barang_masuk/edit/' . $value->id_barang_masuk) ?>" method="post" enctype="multipart/form-data">
        	<div class="form-group">
        		<label>Nama Barang</label>
                <select class="form-control" name="id_stok" id="id_stok">
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach($stok as $stok_item): ?>
                    <option value="<?= $stok_item->id_stok ?>" <?= $stok_item->id_stok == $value->id_stok ? 'selected' : '' ?>>
                        <?= $stok_item->nm_barang ?>
                    </option>
                    <?php endforeach; ?>
                </select>
        	</div>
            <div class="form-group">
        		  <label>Jumlah Barang Masuk</label>
        		  <input type="number" name="jml_masuk" id="jml_masuk" class="form-control" value="<?= $value->jml_masuk ?>" required>
        	</div>
            <div class="form-group">
              <label>Keterangan</label>
        		  <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required><?= $value->keterangan ?></textarea>
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