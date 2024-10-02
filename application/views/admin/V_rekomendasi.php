<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3" style="display:flex">
                        <h6 class="text-white text-capitalize ps-3">Authors table</h6>

                        <button type="button" class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#kirimrekomendasi" style="margin-left: auto; margin-right: 2em;">
                            <lord-icon src="https://cdn.lordicon.com/piwupaqb.json" trigger="hover" stroke="bold" colors="primary:#ffffff,secondary:#0a2e5c" style="width:3rem;height:3rem">
                            </lord-icon>
                        </button>

                    </div>
                    <br>
                </div>
                <div class="card-body px-0 pb-2">
                    <div id="loadingplane" style="display:none">
                        <img src="<?= base_url('aset/loading/planeemail.gif') ?>" alt="Loading..." width="50px" height="50px">
                    </div>
                    <div id="sukses" style="display: none;">
                        <img src="<?= base_url('aset/loading/sent.gif') ?>" alt="Loading..." width="50px" height="50px">
                    </div>
                    </td>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="tabelRekomendasi">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pelanggan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rekomendasi 1</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rekomendasi 2</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rekomendasi 3</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rekomendasi 4</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rekomendasi 5</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rekomendasi 6</th>
                                    <th class="" style="width: 1rem;"></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
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

    <div class="modal fade" id="kirimrekomendasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">

            <form role="form" id="kirimRekomendasiBarang">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Rekomendasi</h1>
                        <div id="loadingplane1" style="display:none">
                            <img src="<?= base_url('aset/loading/planeemail.gif') ?>" alt="Loading..." width="50px" height="50px">
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div>
                            <label for="">Rekomendasi 1</label>
                            <div>
                                <select name="barang1" style="height:2rem">
                                    <?php foreach ($data_barang as $db) : ?>
                                        <option value="<?= $db->id_barang ?>"><?= $db->nama_barang ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="text" placeholder="keterangan1" name="keterangan1" id="keterangan1">
                            </div>
                        </div>
                        <div>
                            <label for="">Rekomendasi 2</label>
                            <div>
                                <select name="barang2" style="height:2rem">
                                    <option value="0">Tidak Pilih</option>
                                    <?php foreach ($data_barang as $db) : ?>
                                        <option value="<?= $db->id_barang ?>"><?= $db->nama_barang ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="text" placeholder="keterangan2" name="keterangan2">
                            </div>
                        </div>
                        <div>
                            <label for="">Rekomendasi 3</label>
                            <div>
                                <select name="barang3" style="height:2rem">
                                    <option value="0">Tidak Pilih</option>
                                    <?php foreach ($data_barang as $db) : ?>
                                        <option value="<?= $db->id_barang ?>"><?= $db->nama_barang ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="text" placeholder="keterangan3" name="keterangan3">
                            </div>
                        </div>
                        <br>
                        <input type="checkbox" name="pilihan" value="1"> Kirimkan Rekomendasi Untuk Semua
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
</div>

<!-- Modal -->
<!-- harusnya di footer -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    setInterval(function() {
        $('#tabelRekomendasi').DataTable().ajax.reload();
    }, 2000);
    $(document).ready(function() {
        $('#tabelRekomendasi').DataTable({
            "ajax": "<?php echo base_url('barang/carirekomendasi'); ?>",
            "order": [], // Nonaktifkan fitur pencarian
            "info": false,
            "language": {
                "emptyTable": "Tidak ada transaksi"
            }
        });
    });

    $(document).on('submit', '#kirimRekomendasi', function(event) {
        event.preventDefault();
        var form = $(this);
        var id_pelanggan = form.find('input[name="id_pelanggan"]').val();
        $('#loading_' + id_pelanggan).show();

        $.ajax({
            url: "<?php echo base_url('rekomendasi/kirimRekomendasiemail'); ?>",
            data: form.serialize(), // Mengambil data dari formulir yang disubmit
            type: "post",
            dataType: 'json',
            success: function(response) {
                $('#loading_' + id_pelanggan).hide();
                $('#sukses_' + id_pelanggan).show();
            },
            error: function() {
                alert("error");
                $('#loading_' + id_pelanggan).hide();
            }
        });
    });

    $(document).on('submit', '#kirimRekomendasiBarang', function(event) {
        event.preventDefault();
        $('#loadingplane').show();
        $('#loadingplane1').show();
        $.ajax({
            url: "<?php echo base_url('rekomendasi/KirimRekomendasiBarang'); ?>",
            data: $("#kirimRekomendasiBarang").serialize(),
            type: "post",
            dataType: 'json',
            success: function(response) {
                alert('Successfully inserted');

            },
            error: function() {
                $('#loadingplane').hide();
                $('#loadingplane1').hide();
                $('#sukses').show();
                setInterval(function() {
                    $('#sukses').hide();
                }, 10000);
            }
        });
    });
</script>