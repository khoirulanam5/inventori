<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 class="h3 mb-0 text-gray-800"><b><?= $title?></b></h3>
	</div>
  <a class="btn btn-sm btn-primary mb-3" href="<?= base_url('laporan/stok') ?>"> Stok Barang</a>
	<a class="btn btn-sm btn-primary mb-3" href="<?= base_url('laporan/barang_masuk') ?>"> Barang Masuk</a>
	<a class="btn btn-sm btn-primary mb-3" href="<?= base_url('laporan/barang_keluar') ?>"> Barang Keluar</a>
	<?= $this->session->flashdata('pesan') ?>
	<div class="card shadow">
		<div class="card-body">
    <a class="btn btn-sm btn-info mb-3 float-right" target="_blank" href="<?= base_url('laporan/barang_keluar/print') ?>"> Print</a>
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="dataTable">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">ID Barang<br>Keluar</th>
							<th class="text-center">Nama Karyawan</th>
              <th class="text-center">Nama Barang</th>
              <th class="text-center">Jumlah</th>
              <th class="text-center">Tanggal Keluar</th>
              <th class="text-center">Keterangan</th>
              <th class="text-center">Verifikasi Admin</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($barang_keluar as $value) : ?>
							<tr class = "text-center">
								<td><?= $no++ ?></td>
								<td><?= $value->id_barang_keluar ?></td>
								<td><?= $value->nm_pengguna ?></td>
                <td><?= $value->nm_barang ?></td>
                <td><?= $value->jml_keluar ?></td>
                <td><?= do_formal_date($value->tgl_keluar) ?></td>
                <td><?= $value->keterangan ?></td>
                <td>
                  <?php if($value->verifikasi == NULL): ?>
                    <a class="badge badge-warning">Belum diverifikasi</a>
                  <?php elseif($value->verifikasi == 'sudah verifikasi'): ?>
                    <a class="badge badge-primary">Sudah diverifikasi</a>
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