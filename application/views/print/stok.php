<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Stok Barang</title>
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
    <h3 style="text-align: left;">Data Stok Barang</h3>
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
    
    <script>
        window.print();
    </script>
</body>
</html>
