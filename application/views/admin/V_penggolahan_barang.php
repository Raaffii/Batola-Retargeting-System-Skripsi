<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3" style="display:flex">
                        <h6 class="text-white text-capitalize"><a href="" <?= base_url("barang/pengolahanDataBarang") ?>" style="color: white; padding:1rem; text-decoration:underline; text-decoration-thickness: 0.4em;">Pengolahan Data Barang</a></h6>
                        <h6 class="text-white text-capitalize"><a href="<?= base_url("barang/pengolahanDataRaxBarang") ?>" style="color: white; padding:1rem;">Pengolahan Data Rax Barang</a></h6>
                        <button type="button" class="btn btn-secondary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#tambahbarang" style="margin-left: auto; margin-right: 2em;">
                            +
                        </button>

                    </div>

                    <br>

                </div>

                <div class="card-body px-0 pb-2">

                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="tabelBarang">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Deskripsi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rax</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock</th>

                                </tr>
                            </thead>
                            <div class="modal fade" id="tambahbarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form role="form" id="createForm" enctype="multipart/form-data">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Input barang</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="input-group input-group-outline mb-3">
                                                    <label class="form-label">Nama Barang</label>
                                                    <input type="text" class="form-control" name="nama_barang" id="nama_barang">
                                                </div>
                                                <div class="input-group input-group-outline mb-3">
                                                    <label class="form-label">Deskripsir</label>
                                                    <input type="text" class="form-control" name="deskripsi" id="nama_suplier">
                                                </div>

                                                <div class="input-group input-group-outline mb-3">
                                                    <label class="form-label">Harga</label>
                                                    <input type="number" class="form-control" name="harga" id="harga">
                                                </div>

                                                <div style="display: flex; gap:1em;">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <select class="form-select" aria-label=".form-select-sm example" name="lokasi" id="pilihrax" onchange="updateJenis()">
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
                                                        <select id="jenis" class="form-select" name="jenis">
                                                            <option value="">Pilih jenis</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline mb-3">
                                                    <input type="file" class="form-control" name="foto" id="foto">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Understood</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                            <tbody id="container">


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php foreach ($data_barang as $db) : ?>
        <div class="modal fade" id="editbarang_<?= $db->id_barang ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form role="form" action="<?= base_url('barang/editBarang/' . $db->id_barang . '') ?>" id="" enctype="multipart/form-data" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit barang <?= $db->nama_barang; ?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="<?= $db->nama_barang; ?>" autofocus>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="deskripsi" id="nama_suplier" value="<?= $db->deskripsi; ?>">
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <input type="number" class="form-control" name="harga" id="harga" value="<?= $db->deskripsi; ?>">
                            </div>

                            <div style="display: flex; gap:1em;">
                                <div class="input-group input-group-outline mb-3">
                                    <select class="form-select" aria-label=".form-select-sm example" name="lokasi" id="pilihrax2" onchange="updateJenis2()">
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
                                    <select id="jenis2" class="form-select" name="jenis">
                                        <option value="">Pilih jenis</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="file" class="form-control" name="foto" id="foto">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Understood</button>
                        </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>



</div>
<!-- harusnya di footer -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    function updateJenis() {
        var pilihan = document.getElementById("pilihrax").value;
        var jenisSelect = document.getElementById("jenis");
        jenisSelect.innerHTML = ""; // Menghapus semua opsi sebelum menambahkan opsi baru


        <?php $y = 1; ?>
        <?php while ($y <= $x) : ?>
            if (pilihan === "<?= $y ?>") {
                var tipeOption = [
                    <?php foreach ($data_tipe as $dt) : ?>
                        <?php if ($y == $dt->lokasi) : ?>
                            <?= $dt->id_tipe ?>,
                        <?php endif ?>
                    <?php endforeach; ?>
                ]; // Opsi untuk Jawa Timur

                var tipeNama = [
                    <?php foreach ($data_tipe as $dt) : ?>
                        <?php if ($y == $dt->lokasi) : ?> '<?= $dt->nama_tipe ?>',
                        <?php endif ?>
                    <?php endforeach; ?>
                ]; // Opsi untuk Jawa Timur
            }
            <?php $y++ ?>
        <?php endwhile; ?>


        // Menambahkan opsi baru ke dalam dropdown kota
        for (var i = 0; i < tipeOption.length; i++) {
            var option = document.createElement("option");
            option.text = tipeNama[i];
            option.value = tipeOption[i];
            jenisSelect.add(option);
        }
    }

    function updateJenis2() {
        var pilihan = document.getElementById("pilihrax2").value;
        var jenisSelect = document.getElementById("jenis2");
        jenisSelect.innerHTML = ""; // Menghapus semua opsi sebelum menambahkan opsi baru


        <?php $y = 1; ?>
        <?php while ($y <= $x) : ?>
            if (pilihan === "<?= $y ?>") {
                var tipeOption = [
                    <?php foreach ($data_tipe as $dt) : ?>
                        <?php if ($y == $dt->lokasi) : ?>
                            <?= $dt->id_tipe ?>,
                        <?php endif ?>
                    <?php endforeach; ?>
                ]; // Opsi untuk Jawa Timur

                var tipeNama = [
                    <?php foreach ($data_tipe as $dt) : ?>
                        <?php if ($y == $dt->lokasi) : ?> '<?= $dt->nama_tipe ?>',
                        <?php endif ?>
                    <?php endforeach; ?>
                ]; // Opsi untuk Jawa Timur
            }
            <?php $y++ ?>
        <?php endwhile; ?>


        // Menambahkan opsi baru ke dalam dropdown kota
        for (var i = 0; i < tipeOption.length; i++) {
            var option = document.createElement("option");
            option.text = tipeNama[i];
            option.value = tipeOption[i];
            jenisSelect.add(option);
        }
    }




    $(document).ready(function() {
        $('#tabelBarang').DataTable({
            "ajax": "<?php echo base_url('barang/caribarang'); ?>",
            "order": [], // Nonaktifkan fitur pencarian
            "info": false,
            "language": {
                "emptyTable": "Tidak ada transaksi"
            }
        });
    });


    $("#createForm").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "<?php echo base_url('barang/masukan_barang'); ?>",
            data: formData,
            type: "post",
            async: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                $('#createForm')[0].reset();
                alert('Successfully inserted');
                $('#exampleTable').DataTable().ajax.reload();
            },
            error: function() {
                alert("error");
            }
        });
    });
</script>
<script>

</script>