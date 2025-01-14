<div class="container-fluid">

    <div class="row">
    <?= $this->session->flashdata('pesan') ?>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah barang masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $barang_masuk ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Barang Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $barang_keluar ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Stok</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stok ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $user ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <center>
                <h4 class="header-title">Selamat Datang <?= $this->session->userdata('nm_pengguna'); ?> di Sistem Inventori Barang.</h4>
                    <p class="text-muted">Anda dapat melakukan pekerjaan anda sesuai dengan jabatan <?= $this->session->userdata('level'); ?> </p>
                <img height="550px" src="<?= base_url('assets/banner.png'); ?>">
                </center>
            </div>
        </div>
    </div>

</div>