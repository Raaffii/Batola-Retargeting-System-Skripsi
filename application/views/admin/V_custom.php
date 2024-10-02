<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-100 border-radius-xl mt-4">

    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6" style="background-color: #E3ECF2;">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="display: flex; gap:2rem">
                    <div>
                        <!-- Tambahkan id pada iframe -->
                        <iframe id="videoFrame" width="1000" height="600" src="http://127.0.0.1:5000/image" frameborder="0" allowfullscreen></iframe>
                        <canvas id="paintCanvas" width="1000" height="600" style="border:1px solid black; position: absolute;"></canvas>
                        <div id="coordinates"></div>
                    </div>
                    <div>
                        <div>
                            <div class="modal-content" style="padding: 1rem; width:15rem">
                                <div class="modal-header">
                                    <h3 class="modal-title fs-5" id="staticBackdropLabel">Custom Setting</h3>
                                    <div id="loadingplane1" style="display:none">
                                        <img src="<?= base_url('aset/loading/planeemail.gif') ?>" alt="Loading..." width="50px" height="50px">
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">On/Off</label>
                                        <?php foreach ($data_custom as $dc) : ?>
                                            <label class="form-check-label" for="flexSwitchCheckChecked" style="color: red;" id="ketcamera">Cam : <?= $dc->sumber_camera ?></label>
                                            <?php $rax = $dc->jumlahRaxBox ?>
                                        <?php endforeach; ?>
                                    </div>

                                </div>
                                <div class="modal-body">
                                    <div class="form-check form-switch">
                                        <form action="<?= base_url("custom/Polylines") ?>" method="post">
                                            <input type="hidden" value="1" name="polylines">
                                            <button>Polylines</button>
                                        </form>
                                    </div>
                                </div>
                                <form class="pt-3" method="post" style="display: flex;" action="<?= base_url("custom/uploadsumbervideo") ?>">
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" id="sumbervideo" placeholder="Sumber Video" name="sumbervideo">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">V</button>
                                    </div>
                                </form>

                                <form class="pt-3" method="post" style="display: flex; flex-direction: column;" action="<?= base_url("custom/uploadsumbervideo") ?>">

                                </form>

                            </div>
                        </div>
                        <br>
                        <div>
                            <div class="modal-content" style="padding: 1rem; width:15rem">
                                <div class="modal-header">
                                    <h3 class="modal-title fs-5" id="staticBackdropLabel">Rax Customise</h3>
                                    <form class="pt-3" method="post" style="display: flex;" action="<?= base_url("custom/tambahRaxbox") ?>">
                                        <div class="input-group input-group-outline mb-3">
                                            <input type="hidden" class="form-control" id="sumbervideo" placeholder="Raxbox" name="raxbox" value="1">
                                        </div>
                                        <?php if ($rax < 3) : ?>
                                            <div>
                                                <button type="submit" class="btn btn-primary">+</button>
                                            </div>
                                        <?php endif; ?>
                                    </form>
                                </div>


                                <div class="modal-body" style="text-align: center;">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="width: 10rem;">
                                        Kasir <i class="fa-solid fa-angle-down"></i>
                                    </button>

                                    <div class="collapse" id="collapseExample">
                                        <form action="<?= base_url("custom/delrax") ?>" method="post">
                                            <input type="hidden" name="idrax" value="">
                                            <button type="submit" class="btn btn-sm bg-gradient-dark">Delete</button>
                                        </form>
                                        <form action="<?= base_url("custom/lokasiRax"); ?>" method="post">
                                            <div class="card card-body">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate4">
                                                    <label class="form-check-label" for="flexCheckIndeterminate">
                                                        check
                                                    </label>

                                                </div>
                                                <input type="color" id="warna" name="warna_4" value="">
                                                <div style="display: flex;">
                                                    <input type="text" name="lokasi1_4" style="width: 4rem;" placeholder="">
                                                    <input type="text" name="lokasi2_4" style="width: 4rem;" placeholder="">
                                                </div>
                                                <div style="display: flex;">
                                                    <input type="text" name="lokasi3_4" style="width: 4rem;" placeholder="">
                                                    <input type="text" name="lokasi4_4" style="width: 4rem;" placeholder="">
                                                </div>
                                                <input type="hidden" name="idrax" value="1">
                                                <input type="hidden" name="xx" value="4">

                                                <button type="submit" class="btn btn-primary">submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php $x = 0; ?>
                                    <?php foreach ($data_lokasi as $dl) : ?>
                                        <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample_<?= $x ?>" aria-expanded="false" aria-controls="collapseExample" style="width: 10rem;">
                                            Rax <?= $x + 1 ?> <i class="fa-solid fa-angle-down"></i>
                                        </button>

                                        <div class="collapse" id="collapseExample_<?= $x ?>">
                                            <form action="<?= base_url("custom/delrax") ?>" method="post">
                                                <input type="hidden" name="idrax" value="<?php echo $dl->id_rax; ?>">
                                                <button type="submit" class="btn btn-sm bg-gradient-dark">Delete</button>
                                            </form>
                                            <form action="<?= base_url("custom/lokasiRax"); ?>" method="post">
                                                <div class="card card-body">

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate_<?= $x ?>">
                                                        <label class="form-check-label" for="flexCheckIndeterminate">
                                                            check
                                                        </label>

                                                    </div>
                                                    <input type="color" id="warna" name="warna_<?= $x ?>" value="<?= $dl->warnaHex ?>">
                                                    <div style="display: flex;">
                                                        <input type="text" name="lokasi1_<?= $x ?>" style="width: 4rem;" placeholder="<?= $dl->lokasi1 ?>">
                                                        <input type="text" name="lokasi2_<?= $x ?>" style="width: 4rem;" placeholder="<?= $dl->lokasi2 ?>">
                                                    </div>
                                                    <div style="display: flex;">
                                                        <input type="text" name="lokasi3_<?= $x ?>" style="width: 4rem;" placeholder="<?= $dl->lokasi3 ?>">
                                                        <input type="text" name="lokasi4_<?= $x ?>" style="width: 4rem;" placeholder="<?= $dl->lokasi4 ?>">
                                                    </div>
                                                    <input type="hidden" name="idrax" value="<?= $dl->id_rax; ?>">
                                                    <input type="hidden" name="xx" value="<?= $x ?>">

                                                    <button type="submit" class="btn btn-primary">submit</button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php $x++; ?>
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
</div>

<label for="cameraSelect">Choose a camera:</label>
<select id="cameraSelect"></select>

<script>
    // Fungsi untuk menambahkan opsi ke elemen select
    function addOption(selectElement, optionText, optionValue) {
        var option = document.createElement("option");
        option.text = optionText;
        option.value = optionValue;
        selectElement.add(option);
    }

    // Dapatkan daftar perangkat media
    navigator.mediaDevices.enumerateDevices()
        .then(function(devices) {
            var cameraSelect = document.getElementById('cameraSelect');
            devices.forEach(function(device) {
                if (device.kind === 'videoinput') {
                    // Tambahkan opsi untuk setiap perangkat kamera yang tersedia
                    addOption(cameraSelect, device.label || 'Camera ' + (cameraSelect.length + 1), device.deviceId);
                }
            });
        })
        .catch(function(error) {
            console.error('Error getting media devices: ', error);
        });
</script>
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

<script>
    // Fungsi untuk mendapatkan posisi mouse relatif terhadap canvas
    function getMousePos(canvas, evt) {
        var rect = canvas.getBoundingClientRect();
        return {
            x: evt.clientX - rect.left,
            y: evt.clientY - rect.top
        };
    }

    // Mengambil referensi ke elemen canvas dan iframe
    var canvas = document.getElementById("paintCanvas");
    var ctx = canvas.getContext("2d");
    var videoFrame = document.getElementById("videoFrame");

    // Event listener untuk menangkap pergerakan mouse pada canvas
    canvas.addEventListener('mousemove', function(evt) {
        var mousePos = getMousePos(canvas, evt);
        var message = 'Mouse position: ' + mousePos.x + ',' + mousePos.y;
        $("#coordinates").text(message);

        // Mengirim koordinat ke server menggunakan AJAX
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('paint/update_coordinate'); ?>",
            data: {
                x: mousePos.x,
                y: mousePos.y
            }
        });
    }, false);

    // Menetapkan posisi dan ukuran canvas agar sama dengan video
    $(document).ready(function() {
        canvas.style.left = videoFrame.offsetLeft + 'px';
        canvas.style.top = videoFrame.offsetTop + 'px';

    });
    var x = <?php echo $x; ?>;
    for (let i = 0; i < x; i++) {
        canvas.addEventListener('click', function(evt) {
            var mousePos = getMousePos(canvas, evt);
            var checkboxChecked = $('#flexCheckIndeterminate_' + i).prop('checked');
            //ctrz dsinii

            if (checkboxChecked) {
                var lokasi1Value = $('input[name="lokasi1_' + i + '"]').val();
                var lokasi2Value = $('input[name="lokasi2_' + i + '"]').val();
                var lokasi3Value = $('input[name="lokasi3_' + i + '"]').val();
                if (lokasi1Value !== '' && lokasi2Value !== '' && lokasi3Value !== '') {

                    $('input[name="lokasi4_' + i + '"]').val(mousePos.x + ',' + mousePos.y);

                } else if (lokasi1Value !== '' && lokasi2Value !== '') {

                    $('input[name="lokasi3_' + i + '"]').val(mousePos.x + ',' + mousePos.y);
                    //$('input[name="lokasi2"]').val('');

                } else if (lokasi1Value !== '') {

                    $('input[name="lokasi2_' + i + '"]').val(mousePos.x + ',' + mousePos.y);

                } else {

                    $('input[name="lokasi1_' + i + '"]').val(mousePos.x + ',' + mousePos.y);

                }
            }

        }, false);
    }

    canvas.addEventListener('click', function(evt) {
        var mousePos = getMousePos(canvas, evt);
        var checkboxChecked = $('#flexCheckIndeterminate' + "4").prop('checked');
        //ctrz dsinii

        if (checkboxChecked) {
            var lokasi1Value = $('input[name="lokasi1_' + "4" + '"]').val();
            var lokasi2Value = $('input[name="lokasi2_' + "4" + '"]').val();
            var lokasi3Value = $('input[name="lokasi3_' + "4" + '"]').val();
            if (lokasi1Value !== '' && lokasi2Value !== '' && lokasi3Value !== '') {

                $('input[name="lokasi4_' + "4" + '"]').val(mousePos.x + ',' + mousePos.y);

            } else if (lokasi1Value !== '' && lokasi2Value !== '') {

                $('input[name="lokasi3_' + "4" + '"]').val(mousePos.x + ',' + mousePos.y);
                //$('input[name="lokasi2"]').val('');

            } else if (lokasi1Value !== '') {

                $('input[name="lokasi2_' + "4" + '"]').val(mousePos.x + ',' + mousePos.y);

            } else {

                $('input[name="lokasi1_' + "4" + '"]').val(mousePos.x + ',' + mousePos.y);

            }
        }

    }, false);
</script>

<script>
    $(document).on('submit', '#sumbervideo', function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('custom/uploadsumbervideo'); ?>",
            data: $("#sumbervideo").serialize(),
            type: "post",
            async: false,
            dataType: 'json',
            success: function(response) {
                alert('Successfully inserted');
            },

        });
    });
</script>