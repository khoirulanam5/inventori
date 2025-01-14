<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Barang Masuk</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        body {
            margin: 30px;
            margin-top: 70px;
            margin-left: 50px;
            margin-right: 50px;
            font-family: Arial, sans-serif;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
        .header-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .header-logo {
            height: 100px;
        }
        .header-text {
            text-align: center;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .signature {
            margin-left: 700px;
            text-align: left;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header-container">
        <div class="header-text">
            <h2><b>Toko Pakaian Farida Fashion</b></h2>
            <p>Alamat: Ds. Serutsadang Rt.02 / Rw.01, Kec. Winong, Kab. Pati.</p>
        </div>
    </div>
    <hr style="border: 2px solid black;">
    
    <!-- Content Section -->
    <h3 style="text-align: left;">Data Barang Masuk</h3>
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
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
    
    <script>
        window.print();
    </script>
</body>
</html>
