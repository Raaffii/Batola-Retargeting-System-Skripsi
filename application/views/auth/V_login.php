<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <h5 class="text-white font-weight-bolder text-center mt-2 mb-0">Batola Jaya</h5>
                                <p class="text-white text-center mt-2 mb-0">Retargeting Recomendation System</p>

                            </div>
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('notif')) : ?>
                                <div class="alert alert-success alert-dismissible text-white" role="alert">
                                    <span class="text-sm">Anda Telah Logout</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('salah')) : ?>
                                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                    <span class="text-sm">Username/Password Mungkin Salah</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('salah2')) : ?>
                                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                    <span class="text-sm">Tidak Ada User</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <form role="form" class="text-start" method="post" action="<?= base_url("auth") ?>">

                                <div class="input-group input-group-outline my-3" style="margin-bottom: 0;">

                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="emailorusername" name="emailorusername">

                                </div>

                                <?= form_error('emailorusername', '<small class="text-danger pl-3">', '</small>') ?>

                                <div class="input-group input-group-outline mb-3">
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="password" name="password">
                                </div>
                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>

                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Masuk</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
<!--   Core JS Files   -->