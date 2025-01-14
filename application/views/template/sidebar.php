<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0C969C;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center m-4" href="">
                <div class="sidebar-brand-text ml-1"><li class="fa fa-tshirt"></li> Toko <br><small>Farida Fashion</small></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('dashboard') ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li>

            <?php if($this->session->userdata('level') == 'PIMPINAN'): ?>
                <li class="nav-item <?= ($this->uri->segment(2) == 'user') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('pimpinan/user') ?>">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data User</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'laporan') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('laporan/stok') ?>">
                        <i class="fas fa-fw fa-file-alt"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($this->session->userdata('level') == 'ADMIN'): ?>
                <li class="nav-item <?= ($this->uri->segment(2) == 'karyawan') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/karyawan') ?>">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data Karyawan</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'stok') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/stok') ?>">
                        <i class="fas fa-fw fa-boxes"></i>
                        <span>Data Stok</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'barang_masuk') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/barang_masuk') ?>">
                        <i class="fas fa-fw fa-cart-plus"></i>
                        <span>Data Barang Masuk</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'barang_keluar') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/barang_keluar') ?>">
                        <i class="fas fa-fw fa-box-open"></i>
                        <span>Data Barang Keluar</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'laporan') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('laporan/stok') ?>">
                        <i class="fas fa-fw fa-file-alt"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($this->session->userdata('level') == 'KARYAWAN'): ?>
                <li class="nav-item <?= ($this->uri->segment(2) == 'barang_masuk') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('karyawan/barang_masuk') ?>">
                        <i class="fas fa-fw fa-cart-plus"></i>
                        <span>Data Barang Masuk</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'barang_keluar') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('karyawan/barang_keluar') ?>">
                        <i class="fas fa-fw fa-box-open"></i>
                        <span>Data Barang Keluar</span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-light topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="navbar">

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <ul class="nav navbar-nav navbar-right">

                                <a class="btn btn-info btn-sm logout" href="<?= base_url('auth/logout') ?>">Logout</a>

                            </ul>

                        </div>
                    </ul>

                </nav>

                <script>
                document.querySelectorAll('.logout').forEach(item => {
                        item.addEventListener('click', function(e) {
                            e.preventDefault(); // Mencegah link agar tidak langsung dijalankan
                            var url = this.getAttribute('href'); // Ambil URL dari atribut href
                            Swal.fire({
                                title: "Yakin ingin keluar?",
                                text: "",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Keluar"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Jika konfirmasi, redirect ke URL penghapusan
                                    window.location.href = url;
                                }
                            });
                        });
                    });
                </script>