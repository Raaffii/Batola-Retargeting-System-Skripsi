<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <?php
                $no = 0;
                $grouped_data = [];
                $total_harga = 0;

                foreach ($transaksi as $tk) {
                    if (!isset($grouped_data[$tk->id_barang])) {
                        $grouped_data[$tk->id_barang] = [
                            'no' => ++$no,
                            'nama_barang' => $tk->nama_barang,
                            'id_transaksi' => $tk->id_transaksi,
                            'harga' => $tk->harga,
                            'id_pelanggan' => $tk->id_pelanggan,
                            'id_yolo' => $tk->id_yolo,
                            'jumlah' => 1,
                        ];
                    } else {
                        $grouped_data[$tk->id_barang]['harga'] += $tk->harga;
                        $grouped_data[$tk->id_barang]['jumlah']++;
                    }
                }

                ?>
                <?php foreach ($grouped_data as $data) : ?>
                    <?php $total_harga = $total_harga + $data['harga'] ?>
                <?php endforeach; ?>
                <div class="col-md-14 mt-4">
                    <div class="card" style="">
                        <div>
                            <div class="card-header pb-0 px-3">
                                <h6 class="mb-0">Barang</h6>
                            </div>

                            <div class="card-body pt-1 p-3">

                                <ul class="list-group">
                                    <h1>Rp. <?= number_format($total_harga, 0, ',', '.') ?></h1>

                                </ul>
                            </div>
                        </div>
                        <div class="jam" style="position: absolute; bottom: 0; right: 0; display:flex; margin-right:1rem">
                            <h5 id="jam">0</h5>
                            <h5> : </h5>
                            <h5 id="menit">0</h5>
                            <h5> : </h5>
                            <h5 id="detik">0</h5>

                        </div>
                    </div>

                </div>

                <div class=" col-xl-6 " style=" margin-top: 1rem;">
                    <div class="row position-relative">
                        <div class="col-md-6 col-6">
                            <div class="card">
                                <?php
                                if (!empty($transaksi)) {
                                    $tr = reset($transaksi);
                                    echo '<h3 style="text-align: center;">' . $tr->nama_pelanggan . '</h3>';
                                } else {
                                    echo '<h3 style="text-align: center;">belum tercatat</h3>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="card">
                                <?php
                                if (!empty($transaksi)) {
                                    $tr = reset($transaksi);
                                    echo '<h3 style="text-align: center;">' . $tr->id_yolo . '</h3>';
                                } else {
                                    echo '<h3 style="text-align: center;">belum tercatat</h3>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row position-relative" style="margin-top: 1rem;">
                        <div class="col-md-6 col-6">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                        <i class="fa-solid fa-user-astronaut"></i>

                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <div action="" id="customer_show">

                                    </div>
                                    <form role="form" action="<?= base_url('user/cari_customer') ?>" class="text-start" method="post">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Customer</label>
                                            <input type="number" class="form-control" name="cari_customer" id="cari_customer">
                                            <button class="btn btn-outline-primary btn-sm mb-0" id="tombol-cari"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>

                                    </form>
                                    <span class="text-xs" id="no_cek"></span>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                        <i class="material-icons opacity-10">account_balance_wallet</i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <div action="" id="yolo_show">

                                    </div>
                                    <form role="form" action="<?= base_url('user/masukan_yolo_ongo') ?>" class="text-start" method="post">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Yolo Track</label>
                                            <input type="number" class="form-control" name="yolo">
                                            <button class="btn btn-outline-primary btn-sm mb-0" id="tombol-cari"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>

                                    </form>
                                    <span class="text-xs"></span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 ">
                    <div class="card bg-transparent shadow-xl">
                        <div class="overflow-hidden position-relative border-radius-xl">

                            <div class="card-body position-relative z-index-1 p-3">
                                <form role="form" action="<?= base_url("user/cari") ?>" class="text-start" method="post">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Cari</label>
                                        <input type="text" class="form-control" name="pencarian" id="pencarian">
                                        <button class="btn btn-outline-primary btn-sm mb-0" id="tombol-cari"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>

                                </form>


                                <div class="d-flex" id="container">
                                    <ul class="list-group">


                                        <li id="card">

                                        </li>


                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Pembelian</h6>
                        </div>

                    </div>
                </div>
                <div class="card-body p-3 pb-0">
                    <?php $id_yolo = 0;
                    $id_pelanggan = 0; ?>
                    <?php foreach ($grouped_data as $data) : ?>
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark font-weight-bold text-sm"><?= $data['nama_barang'] ?></h6>
                                    <span class="text-xs">is barang</span>
                                </div>
                                <div class="d-flex align-items-center text-sm">
                                    <?= $data['jumlah'] ?>
                                </div>
                                <div class="d-flex align-items-center text-sm">
                                    <?= number_format($data['harga'], 0, ',', '.') ?>

                                    <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="material-icons text-lg position-relative me-1">picture_as_pdf</i> PDF</button>
                                </div>
                            </li>
                        </ul>
                        <?php $id_yolo = $data['id_yolo'] ?>
                        <?php $id_pelanggan = $data['id_pelanggan'] ?>
                    <?php endforeach; ?>


                    <div class="mx-3">
                        <form action="<?= base_url('user/konfirmasibeli/') ?>" method="post">
                            <input type="hidden" value="<?= $id_yolo ?>" name="id_yolo">
                            <input type="hidden" value="<?= $id_pelanggan ?>" name="id_pelanggan">
                            <button class="btn bg-gradient-primary mt-4 w-100" type="submit">Consfirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    var cari_customer = document.getElementById('cari_customer')
    var customer_show = document.getElementById('customer_show')
    cari_customer.addEventListener('keyup', function() {

        var ajax = new XMLHttpRequest();

        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                customer_show.innerHTML = ajax.responseText;
                no_cek.innerHTML = cari_customer.value

            }
        }
        ajax.open('GET', 'cari_customer?pencarian=' + cari_customer.value, true);
        ajax.send();

    });



    var pencarian = document.getElementById('pencarian')
    var tombolcari = document.getElementById('tombol-cari')
    var container = document.getElementById('container')



    pencarian.addEventListener('keyup', function() {

        //buat objek ajax
        var xhr = new XMLHttpRequest();

        // cek kesiapan ajax
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                container.innerHTML = xhr.responseText;
            }
        }
        xhr.open('GET', 'cari_barang?pencarian=' + pencarian.value, true);
        xhr.send();

    });

    var jam = document.getElementById('jam')
    var menit = document.getElementById('menit')
    var detik = document.getElementById('detik')

    setInterval(() => {
        var waktu = new Date();

        jam.innerHTML = (waktu.getHours() < 10 ? "0" : "") + waktu.getHours();
        menit.innerHTML = (waktu.getMinutes() < 10 ? "0" : "") + waktu.getMinutes();
        detik.innerHTML = (waktu.getSeconds() < 10 ? "0" : "") + waktu.getSeconds();
    }, 1000)
</script>