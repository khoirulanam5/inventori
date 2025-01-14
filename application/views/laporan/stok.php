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
    <a class="btn btn-sm btn-info mb-3 float-right" target="_blank" href="<?= base_url('laporan/stok/print') ?>"> Print</a>
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
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>