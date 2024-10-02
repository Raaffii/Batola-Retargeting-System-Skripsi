<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3" style="display:flex">
                        <h6 class="text-white text-capitalize ps-3">Authors table</h6>

                        <button type="button" class="btn btn-secondary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#tambahbarang" style="margin-left: auto; margin-right: 2em;">
                            +
                        </button>
                    </div>
                    <br>
                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Cari</label>
                        <input type="text" class="form-control" name="pencarian" id="pencarian">
                    </div>
                </div>
                <div class="card-body px-0 pb-2">

                    <div class="table-responsive p-0">

                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Suplier</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody id="container">






                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="tambahbarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form role="form" id="createForm">
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
                            <label class="form-label">Suplier</label>
                            <input type="text" class="form-control" name="suplier" id="nama_suplier">
                        </div>

                        <div style="display: flex; gap:1em;">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" class="form-control" name="harga" id="harga">
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" class="form-control" name="stok" id="stok">
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Understood</button>
                    </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
</div>
<!-- harusnya di footer -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $("#createForm").submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('barang/masukan_barang'); ?>",
            data: $("#createForm").serialize(),
            type: "post",
            async: false,
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
        xhr.open('GET', './barang/cariBarang?pencarian=' + pencarian.value, true);
        xhr.send();

    });
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            container.innerHTML = xhr.responseText;
        }
    }
    xhr.open('GET', './barang/cariBarang?pencarian=' + pencarian.value, true);
    xhr.send();
</script>