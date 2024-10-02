<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3" style="display:flex">
                        <h6 class="text-white text-capitalize"><a href="<?= base_url("barang/pengolahanDataBarang") ?>" style=" color: white; padding:1rem;">Pengolahan Data Barang</a></h6>
                        <h6 class="text-white text-capitalize"><a href="<?= base_url("barang/pengolahanDataRaxBarang") ?>" style="color: white; padding:1rem; text-decoration:underline; text-decoration-thickness: 0.4em;">Pengolahan Data Rax Barang</a></h6>
                        <a type="button" class="btn btn-secondary btn-sm mb-0" href="<?= base_url("custom") ?>" style="margin-left: auto; margin-right: 2em;">
                            Rax Box
                        </a>
                    </div>

                    <br>
                    <button class="btn btn-primary btn-sm mb-0" button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">+ Tipe</button>
                    <button type="button" class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#deletetipe" style="margin-left: auto; margin-right: 2em;">
                        delete Tipe
                    </button>

                    <p>.</p>
                </div>

            </div>
            <div class="row mb-4">

                <?php $x = 1 ?>
                <?php while ($x <= $lokasi) : ?>
                    <?php if ($x == 4 || $x == 7 || $x == 8) : ?>
                        <label for="">.</label>
                    <?php endif; ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="card-header pb-0">

                                <?php if (isset($data_rax[$x - 1]->warnaHex)) : ?>
                                    <?php if ($data_rax[$x - 1]->lokasi3 == "0, 0") : ?>

                                        <h6>RAX <?= $x ?> </h6>
                                        <h6 style="background-color: <?= $data_rax[$x - 1]->warnaHex ?>; color:red">Rax Box Mungin belum diatur <i class="fa-solid fa-circle-exclamation"></i></h6>
                                    <?php else : ?>
                                        <h6>RAX <?= $x ?> </h6>
                                        <?php foreach ($data_tipe as $dt) : ?>
                                            <?php if ($x == $dt->lokasi) : ?>
                                                <h6 style=" background-color: <?= $data_rax[$x - 1]->warnaHex ?>; color:white; display: flex; justify-content: space-between; text-align:right">
                                                    <?= $dt->nama_tipe ?>
                                                    <button type="button" class="btn btn-secondary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#movetipe_<?= $dt->id_tipe ?>" style="margin-left: auto; margin-right: 2em;">
                                                        move
                                                    </button>


                                                </h6>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <h6 style="color: red;">RAX <?= $x ?> <i class="fa-solid fa-circle-exclamation"></i></h6>
                                    <h6 style="color: red;">Rax Box Tidak Ada <i class="fa-solid fa-circle-exclamation"></i></h6>
                                <?php endif ?>
                            </div>
                            <div class="card-body p-3">
                                <div class="timeline timeline-one-side">
                                    <div class="timeline-block mb-3">

                                        <?php foreach ($data_barang as $db) : ?>
                                            <?php if ($x == $db->location) : ?>
                                                <div class="timeline-content" style="display: flex; justify-content: space-between;">
                                                    <div style="width: 15rem;">
                                                        <h6 class="text-dark text-sm font-weight-bold mb-0"><?= $db->nama_barang; ?></h6>
                                                    </div>

                                                    <h6><?= $db->nama_tipe ?></h6>
                                                    <!-- 
                                                    <button type="button" class="btn btn-secondary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#movebarang_<?= $db->id_barang ?>" style="margin-left: auto; margin-right: 2em;">
                                                        move
                                                    </button>
                                                     -->
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php $x++ ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form role="form" enctype="multipart/form-data" method="post" action="<?= base_url("barang/tambahTipe") ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Tipe</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-outline mb-3">
                            <select class="form-select" aria-label=".form-select-sm example" name="rax">
                                <option selected>.Pilih Rax</option>
                                <?php $x = 1 ?>
                                <?php foreach ($data_rax as $dr) : ?>
                                    <option value="<?= $x ?>" style="text-align:center; background-color: <?= $dr->warnaHex ?>; color: white;">
                                        <h4 style=""> Rax <?= $x ?></h4>
                                    </option>
                                    <?php $x++; ?>
                                <?php endforeach ?>
                            </select>

                            <input type="text" class="form-control" name="namatipe" placeholder="nama tipe">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
</div>
<?php foreach ($data_barang as $db) : ?>
    <div class="modal fade" id="movebarang_<?= $db->id_barang ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form role="form" enctype="multipart/form-data" method="post" action="<?= base_url("barang/moveRax") ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Move Barang</h1>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p style="text-decoration: underline;"><?= $db->nama_barang ?></p>
                        <div class="input-group input-group-outline mb-3">
                            <select class="form-select" aria-label=".form-select-sm example" name="rax">
                                <option selected>.Pilih Rax</option>
                                <?php $x = 1 ?>
                                <?php foreach ($data_rax as $dr) : ?>
                                    <option value="<?= $x ?>" style="text-align:center; background-color: <?= $dr->warnaHex ?>; color: white;">
                                        <h4 style=""> Rax <?= $x ?></h4>
                                    </option>
                                    <?php $x++; ?>
                                <?php endforeach ?>
                            </select>

                            <input type="hidden" name="idbarang" value="<?= $db->id_barang ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>


<div class="modal fade" id="deletetipe" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" enctype="multipart/form-data" method="post" action="<?= base_url("barang/deleteTipe") ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Tipe</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p style="text-decoration: underline;"><?= $db->nama_tipe ?></p>
                    <div style="display: flex; gap:1em;">
                        <div class="input-group input-group-outline mb-3">
                            <select class="form-select" aria-label=".form-select-sm example" name="lokasi" id="pilihrax2_<?= $dt->id_tipe ?>" onchange="updateJenis2('<?= $dt->id_tipe ?>')">
                                <option selected>.Pilih Rax</option>
                                <?php $x = 1 ?>
                                <?php foreach ($data_rax as $dr) : ?>
                                    <option value="<?= $x ?>" style="background-color: <?= $dr->warnaHex ?>; text-align:center">
                                        <h4> Rax <?= $x ?></h4>
                                    </option>
                                    <?php $x++; ?>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <select id="jenis2_<?= $dt->id_tipe ?>" class="form-select" name="jenis">
                                <option value="">Pilih jenis</option>
                            </select>
                        </div>
                        <input type="hidden" name="idtipe" value="<?= $dt->id_tipe ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </form>
    </div>
</div>



<?php foreach ($data_tipe as $dt) : ?>
    <div class="modal fade" id="movetipe_<?= $dt->id_tipe ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form role="form" enctype="multipart/form-data" method="post" action="<?= base_url("barang/moveTipe") ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Move tipe</h1>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p style="text-decoration: underline;"><?= $dt->nama_tipe ?></p>
                        <div class="input-group input-group-outline mb-3">
                            <select class="form-select" aria-label=".form-select-sm example" name="rax">
                                <option selected>.Pilih Rax</option>
                                <?php $x = 1 ?>
                                <?php foreach ($data_rax as $dr) : ?>
                                    <option value="<?= $x ?>" style="text-align:center; background-color: <?= $dr->warnaHex ?>; color: white;">
                                        <h4 style=""> Rax <?= $x ?></h4>
                                    </option>
                                    <?php $x++; ?>
                                <?php endforeach ?>
                            </select>
                            <input type="hidden" name="idtipe" value="<?= $dt->id_tipe ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>
<!-- harusnya di footer -->
<?php foreach ($data_tipe as $dt) : ?>
    <script>
        function updateJenis2(id_tipe) {
            var pilihan = document.getElementById("pilihrax2_" + id_tipe).value;
            var jenisSelect = document.getElementById("jenis2_" + id_tipe);
            jenisSelect.innerHTML = ""; // Menghapus semua opsi sebelum menambahkan opsi baru

            var tipeOption = [];
            var tipeNama = [];

            <?php foreach ($data_tipe as $dt) : ?>
                if (pilihan === "<?= $dt->lokasi ?>") {
                    tipeOption.push(<?= $dt->id_tipe ?>);
                    tipeNama.push('<?= $dt->nama_tipe ?>');
                }
            <?php endforeach; ?>

            // Menambahkan opsi baru ke dalam dropdown kota
            for (var i = 0; i < tipeOption.length; i++) {
                var option = document.createElement("option");
                option.text = tipeNama[i];
                option.value = tipeOption[i];
                jenisSelect.add(option);
            }
        }
    </script>
<?php endforeach; ?>