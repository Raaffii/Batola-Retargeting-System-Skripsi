<div class="container-fluid py-4">

    <div class="row">
        <div class="col-lg-8">

            <!-- MULAI ROWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW-->
            <div class="row">



                <iframe src="http://127.0.0.1:5000/image" frameborder="0" width="500rem" height="300rem" id="videoFrame"></iframe>

                <div class="col-md-14 mt-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                        <label class="form-check-label" for="flexSwitchCheckChecked">On/Off</label>

                        <label class="form-check-label" for="flexSwitchCheckChecked" style="color: red;" id="ketcamera">Cam : |||</label>

                    </div>
                    <div class="card">
                        <div>
                            <div class="card-header pb-0 px-3">
                                <h3 class="mb-0">Total</h3>
                            </div>

                            <div class="card-body pt-1 p-3">

                                <ul class="list-group">
                                    <table class="table" id="tabeltotalharga">
                                        <thead>

                                            <th> </th>

                                        </thead>



                                    </table>
                                </ul>
                            </div>
                        </div>

                        <div class="" style="position: absolute; top: 0; right: 0;  margin-right:1rem; margin-top:1rem; text-align:right; color:#e91e63;">

                            <table class="" id="tabelpelanggandanyolo">
                                <thead>

                                    <th> </th>


                                </thead>
                                <tbody>

                                </tbody>



                            </table>

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

                <!-- untuk masukan pealnggan dan yolonya -->
                <div class=" col-xl-6 ">
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
                                    <form role="form" action="" class="text-start" method="post" id="cutomerForm">
                                        <div class="input-group input-group-outline my-3">
                                            <input type="number" class="form-control" name="cari_customer" id="cari_customer" placeholder="Cari Customer">
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
                                            <input type="number" class="form-control" name="cari_yolo" id="cari_yolo" placeholder="Yolo Track">
                                            <button class="btn btn-outline-primary btn-sm mb-0" id="tombol-cari"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>

                                    </form>
                                    <span class="text-xs"></span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- untuk list barangnya  -->
                <div class="col-xl-6 ">
                    <div class="card bg-transparent shadow-xl">
                        <div class="overflow-hidden position-relative border-radius-xl">

                            <div class="card-body position-relative z-index-1 p-3">
                                <form role="form" action="<?= base_url("user/cari") ?>" class="text-start" method="post">
                                    <div class="input-group input-group-outline my-3">

                                        <input type="text" class="form-control" name="pencarian" id="pencarian" placeholder="cari">
                                        <button class="btn btn-outline-primary btn-sm mb-0" id="tombol-cari"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>

                                </form>
                                <div class="d-flex" id="container">

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
                    <table class="table" id="tabeltransaksi">
                        <thead>

                            <th> </th>
                            <th> </th>
                            <th> </th>
                            <th> </th>
                            <th> </th>
                        </thead>

                    </table>


                    <div class="mx-3">
                        <form action="" method="post" id="konfirmasibeli">
                            <button class="btn bg-gradient-primary mt-4 w-100" type="submit">Consfirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    // Ambil checkbox dan iframe
    const switchCheckbox = document.getElementById('flexSwitchCheckChecked');
    const videoFrames = document.getElementById('videoFrame');
    const ketCamera = document.getElementById('ketcamera');

    // Tambahkan event listener untuk perubahan status toggle
    switchCheckbox.addEventListener('change', function() {
        if (this.checked) {
            // Jika toggle diaktifkan, ganti src iframe menjadi video2
            videoFrames.src = "http://127.0.0.1:5000/video";
            ketCamera.style.color = "green";
        } else {
            // Jika toggle dimatikan, ganti src iframe menjadi videooff
            videoFrames.src = "http://127.0.0.1:5000/image";
            ketCamera.style.color = "red";

        }
    });
</script>

<script type="text/javascript">
    setInterval(function() {
        $('#tabeltransaksi').DataTable().ajax.reload();
        $('#tabeltotalharga').DataTable().ajax.reload();
        $('#tabelpelanggandanyolo').DataTable().ajax.reload();
    }, 1000);


    $(document).ready(function() {
        $('#tabeltransaksi').DataTable({
            "ajax": "<?php echo base_url('transaksi/ambilDataTransaksi'); ?>",
            "order": [],
            "searching": false, // Nonaktifkan fitur pencarian
            "paging": false,
            "info": false,
            "language": {
                "emptyTable": "Tidak ada transaksi"
            }
        });
    });


    $(document).ready(function() {
        $('#tabeltotalharga').DataTable({
            "ajax": "<?php echo base_url('transaksi/ambilTotalHarga'); ?>",
            "order": [],
            "searching": false, // Nonaktifkan fitur pencarian
            "paging": false,
            "info": false,
            "language": {
                "emptyTable": "<h1> Rp. 0</h1>"
            }
        });
    });

    $(document).ready(function() {
        $('#tabelpelanggandanyolo').DataTable({
            "ajax": "<?php echo base_url('transaksi/ambilPelangganDanYolo'); ?>",
            "order": [],
            "searching": false, // Nonaktifkan fitur pencarian
            "paging": false,
            "info": false,

        });
    });
</script>
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
        ajax.open('GET', '../customer/cari_customer?pencarian=' + cari_customer.value, true);
        ajax.send();

    });

    var cari_yolo = document.getElementById('cari_yolo')
    var yolo_show = document.getElementById('yolo_show')
    cari_yolo.addEventListener('keyup', function() {

        var ajax = new XMLHttpRequest();

        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                yolo_show.innerHTML = ajax.responseText;
            }
        }
        ajax.open('GET', '../customer/cari_yolo?pencarian=' + cari_yolo.value, true);
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
        xhr.open('GET', '../barang/cariBarangsatu?pencarian=' + pencarian.value, true);
        xhr.send();

    });
</script>

<script>
    $(document).on('submit', '#createForm', function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('user/masukan_keranjang'); ?>",
            data: $("#createForm").serialize(),
            type: "post",
            async: false,
            dataType: 'json',
            success: function(response) {
                alert("masuk")
                $('#createForm')[0].reset();

                $('#exampleTable').DataTable().ajax.reload();
            },
            error: function() {
                alert("error");
            }
        });
    });
    $(document).on('submit', '#konfirmasibeli', function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('user/konfirmasibeli'); ?>",
            data: $("#konfirmasibeli").serialize(),
            type: "post",
            async: false,
            dataType: 'json',
            success: function(response) {
                alert('Successfully inserted');
            },


        });
    });
    $(document).on('submit', '#plusbarang', function(event) {
        event.preventDefault();
        var form = $(this);
        $.ajax({
            url: "<?php echo base_url('user/masukan_keranjang'); ?>",
            data: form.serialize(),
            type: "post",
            async: false,
            dataType: 'json',
            error: function() {
                alert("error");
            }
        });
    });

    $(document).on('submit', '#minusbarang', function(event) {
        event.preventDefault();
        var form = $(this);
        $.ajax({
            url: "<?php echo base_url('user/hapusKeranjangsatu'); ?>",
            data: form.serialize(),
            type: "post",
            async: false,
            dataType: 'json',
            error: function() {
                alert("error");
            }
        });
    });
    $(document).on('submit', '#hapusbarang', function(event) {
        event.preventDefault();
        var form = $(this);
        $.ajax({
            url: "<?php echo base_url('user/hapusBarang'); ?>",
            data: form.serialize(),
            type: "post",
            async: false,
            dataType: 'json',
            error: function() {
                alert("error");
            }
        });
    });

    $(document).on('submit', '#customerForm', function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('user/masukan_customer_ongo'); ?>",
            data: $("#customerForm").serialize(),
            type: "post",
            async: false,
            dataType: 'json',
            success: function(response) {
                alert('Successfully inserted');

            },
            error: function() {
                alert("error");
            }
        });
    });

    $(document).on('submit', '#tambahCustomer', function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('customer/tambahCustomer'); ?>",
            data: $("#tambahCustomer").serialize(),
            type: "post",
            async: false,
            dataType: 'json',
            success: function(response) {
                alert('Successfully inserted');

            },
            error: function() {
                alert("error");
            }
        });
    });

    $(document).on('submit', '#yoloForm', function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('user/masukan_yolo_ongo'); ?>",
            data: $("#yoloForm").serialize(),
            type: "post",
            async: false,
            dataType: 'json',
            success: function(response) {
                alert('Successfully inserted');

            },
            error: function() {
                alert("error");
            }
        });
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