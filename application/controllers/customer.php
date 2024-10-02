  <?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set("Asia/Jakarta");
    class customer extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model("M_barang");
            $this->load->model("M_transaksi");
            $this->load->model("M_customer");
            $this->load->model('M_pelanggan');
            $this->load->model('M_realtime');
        }
        public function cari_customer()
        {
            $cari = $_GET['pencarian'];
            $orang = $this->M_customer->cari_customer($cari);

            foreach ($orang as $or) {
                $output = '

                <form action="' . base_url("user/masukan_customer_ongo/") . '" method="post" id="customerForm">
        
                <h6 class="text-center mb-0" id="customer_show">' . $or->nama_pelanggan . '</h6>
                <input type="hidden" value="' . $or->id_pelanggan . ' " name="id_pelanggan">
                <button><i class="fa-solid fa-floppy-disk"></i></button>

                </form>';
            }

            $output2 = '  <button class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#tambahmember"><i class="fa-solid fa-plus"></i></button>
            <div class="modal fade" id="tambahmember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form role="form" method="post" action="' . base_url('customer/tambahCustomer') . '">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Member</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control" name="nama_pelanggan" id="nama_barang" placeholder="Nama Pelanggan">
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control" name="no_telp" id="nomer_telfon"  placeholder="Nomer Telfon">
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="email" class="form-control" name="email" id="email"  placeholder="Email">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>';
            if ($orang != NULL) {
                echo $output;
            } else {
                echo $output2;
            }
        }

        public function tampilkan_customer_ongo()
        {
        }

        public function tambahCustomer()
        {
            $data = [
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'no_telp' => $this->input->post('no_telp'),
                'email' => $this->input->post('email'),
            ];

            $this->M_customer->inputCustomer($data);

            redirect('user/pembelian');
        }
    }
