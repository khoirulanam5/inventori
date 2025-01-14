<body class="bg-gradient-white" style="background-color: #0C969C;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Toko Farida Fashion</h1>
                                    </div>
                                    <?= $this->session->flashdata('pesan') ?>
                                    <form method="post" action="<?= base_url('auth/login') ?>">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" placeholder="Masukan Username Anda..." name="username">
                                            <?= form_error('username', '<div class="text-danger small ml-2">', '</div>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" placeholder="Masukan Password Anda..." name="password">
                                            <?= form_error('password', '<div class="text-danger small ml-2">', '</div>') ?>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-info col-md-3">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>

</html>