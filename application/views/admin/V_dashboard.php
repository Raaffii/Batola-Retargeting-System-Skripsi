<div class="container-fluid px-2 px-md-4">

    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1534723452862-4c874018d66d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <span class="mask  bg-gradient-primary  opacity-6" style="text-align: center;">
            <br><br><br>
            <h4 style="color: #E3ECF2;">Batola Jaya Admin</h4>
        </span>


    </div>

    <div class="card card-body mx-3 mx-md-4 mt-n6" style="background-color: #E3ECF2;">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">weekend</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Pendapatan Hari Ini</p>
                                <h4 class="mb-0"><?= number_format($total, 0, ',', '.') ?></h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <?php if ($margin > 0) : ?>
                                <p class="mb-0"><span class="text-success text-sm font-weight-bolder"><?= number_format($margin, 0, ',', '.') ?></span> than lask week</p>
                            <?php else : ?>
                                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"><?= number_format($margin, 0, ',', '.') ?></span> than lask week</p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Pendapatan Pekan Ini</p>
                                <h4 class="mb-0"><?= number_format($totalpekan, 0, ',', '.') ?></h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">-</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Pelanggan Hari Ini</p>
                                <h4 class="mb-0"><?= number_format($pgtoday, 0, ',', '.') ?></h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <?php if ($pgtoday >= $pgyesterday) : ?>
                                <p class="mb-0">Pelanggan Kemarin : <span class="text-success text-sm font-weight-bolder"><?= number_format($pgyesterday, 0, ',', '.') ?></span> <i class="fa fa-arrow-up text-success" aria-hidden="true"></i></p>
                            <?php else : ?>
                                <p class="mb-0">Pelanggan Kemarin : <span class="text-danger text-sm font-weight-bolder"><?= number_format($pgyesterday, 0, ',', '.') ?> <i class="fa fa-arrow-down text-danger" aria-hidden="true"></i></span></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Pelanggan Pekan Ini</p>
                                <h4 class="mb-0"><?= number_format($jumlahpelangganPekan, 0, ',', '.') ?></h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>-</p>
                        </div>
                    </div>
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Pelanggan Pekan Ini</h6>
                            <p class="text-sm ">Jumlah Pelanggan</p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm"> <?= date('d-m-Y') ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mb-3">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 "> Pendapatan Pekan Ini </h6>
                            <p class="text-sm "> Pendapatan </p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm"> <?= date('d-m-Y') ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <?php if ($this->session->flashdata('notif')) : ?>
                        <div class="alert alert-success alert-dismissible text-white" role="alert">
                            <span class="text-sm">Data Berhasil Ditambahkan</span>
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <button type="button" class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#kirimrekomendasi" style="margin-left: auto; margin-right: 2em;">
                                <lord-icon src="https://cdn.lordicon.com/xzalkbkz.json" trigger="hover" colors="primary:#ffffff,secondary:#000000" style="width:50px;height:50px">
                                </lord-icon>

                            </button>
                            <h6>Tambah Pegawai</h6>
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Toko Custom<i class="fa-solid fa-chevron-down"></i>
                            </button>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <div id="loadingplane1" style="display:none">
                                        <img src="<?= base_url('aset/loading/planeemail.gif') ?>" alt="Loading..." width="50px" height="50px">
                                    </div>
                                    <?php foreach ($data_custom as $dc) : ?>
                                        <form action="<?= base_url("custom/customToko") ?>" role="form" method="post" enctype="multipart/form-data">
                                            <img src="<?= base_url('aset/bg.png') ?>" alt="" width="100rem">
                                            <input type="file" class="" name="foto" id="foto" value="<?= $dc->logo_toko ?>">
                                            <input type="text" class="" id="exampleInputUsername1" placeholder="Nama Toko" name="namatoko" value="<?= $dc->nama_toko ?>">
                                            <input type="text" class="" id="exampleInputUsername1" placeholder="Nomer Toko" name="notoko" value="<?= $dc->no_toko ?>">
                                            <input type="text" class="" id="exampleInputUsername1" placeholder="Alamat Toko" name="alamattoko" value="<?= $dc->alamat_toko ?>">
                                            <button type="submit">submit</button>
                                        </form>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



</form>

<div class="modal fade" id="kirimrekomendasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form class="pt-3" method="post" action='<?= base_url('auth/register'); ?>'>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Pegawai</h1>
                    <div id="loadingplane1" style="display:none">
                        <img src="<?= base_url('aset/loading/planeemail.gif') ?>" alt="Loading..." width="50px" height="50px">
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="name" name="name">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" name="username">
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="input-group input-group-outline mb-3" style="gap: 1rem;">
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password1">
                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Repeat Password" name="password2">
                        <?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Understood</button>
                </div>
        </form>
    </div>
</div>
<