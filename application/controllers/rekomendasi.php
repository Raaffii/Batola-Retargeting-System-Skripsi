<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");
class rekomendasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_barang");
        $this->load->model("M_transaksi");
        $this->load->model("M_customer");
        $this->load->model('M_pelanggan');
        $this->load->model('M_realtime');
        $this->load->model('M_saw');
        $this->load->model('M_custom');
    }

    public function index()
    {
        //$data['data_barang'] = $this->M_barang->ambildata();
        $this->template->load('admin/template', 'admin/V_penggolahan_barang');
    }

    public function kirimRekomendasi($id)
    {
        $data_idpelanggan = $this->M_saw->ambildata($id);

        foreach ($data_idpelanggan as $dp) {
            $id_pelanggan = $dp->id_user;
            $C1 = $dp->nama_barang_c1;
            $C2 = $dp->nama_barang_c2;
            $C3 = $dp->nama_barang_c3;
            $C4 = $dp->nama_barang_c4;
            $C5 = $dp->nama_barang_c5;
            $C6 = $dp->nama_barang_c6;
        }

        $data_pelanggan = $this->M_pelanggan->ambilpelanggan($id_pelanggan);

        foreach ($data_pelanggan as $dp) {
            if (substr($dp->no_telp, 0, 1) === '0') {
                $no_telp = '62' . substr($dp->no_telp, 1);
            }
        }


        $pesan = "+Pisang+Lifebuoy+Nuvo&type=phone_number&app_absent=0";

        $wa_link = "https://api.whatsapp.com/send/?phone=6283115266100&text=%2BPisang%2BLifebuoy%2BNuvo%26type%3Dphone_number%26app_absent%3D0";

        redirect("$wa_link");
        // redirect(base_url());
    }

    public function kirimRekomendasiemail()
    {
        $id = $this->input->post('id_pelanggan');
        $data_idpelanggan = $this->M_saw->ambildata($id);
        $data_custom = $this->M_custom->ambildata();

        foreach ($data_idpelanggan as $dp) {
            $id_pelanggan = $dp->id_user;
            $C1 = $dp->C1;
            $C2 = $dp->C2;
            $C3 = $dp->C3;
            $C4 = $dp->C4;
            $C5 = $dp->C5;
            $C6 = $dp->C6;
        }

        foreach ($data_custom as $dc) {
            $namatoko = $dc->nama_toko;
            $notoko = $dc->no_toko;
            $alamattoko = $dc->alamat_toko;
        }

        //ambil C1

        $data_C1 = $this->M_barang->ambildataid($C1);

        foreach ($data_C1 as $dC1) {
            $nama_barang_C1 = $dC1->nama_barang;
            $harga_C1 = $dC1->harga;
            $deskripsi_C1 = $dC1->deskripsi;
            $foto_C1 = $dC1->foto;
        }

        $data_C2 = $this->M_barang->ambildataid($C2);

        foreach ($data_C2 as $dC2) {
            $nama_barang_C2 = $dC2->nama_barang;
            $harga_C2 = $dC2->harga;
            $deskripsi_C2 = $dC2->deskripsi;
            $foto_C2 = $dC2->foto;
        }

        $data_C3 = $this->M_barang->ambildataid($C3);

        foreach ($data_C3 as $dC3) {
            $nama_barang_C3 = $dC3->nama_barang;
            $harga_C3 = $dC3->harga;
            $deskripsi_C3 = $dC3->deskripsi;
            $foto_C3 = $dC3->foto;
        }

        $data_C4 = $this->M_barang->ambildataid($C4);

        foreach ($data_C4 as $dC4) {
            $nama_barang_C4 = $dC4->nama_barang;
            $harga_C4 = $dC4->harga;
            $deskripsi_C4 = $dC4->deskripsi;
            $foto_C4 = $dC4->foto;
        }

        $data_C5 = $this->M_barang->ambildataid($C5);

        foreach ($data_C5 as $dC5) {
            $nama_barang_C5 = $dC5->nama_barang;
            $harga_C5 = $dC5->harga;
            $deskripsi_C5 = $dC5->deskripsi;
            $foto_C5 = $dC5->foto;
        }

        $data_C6 = $this->M_barang->ambildataid($C1);

        foreach ($data_C6 as $dC6) {
            $nama_barang_C6 = $dC6->nama_barang;
            $harga_C6 = $dC6->harga;
            $deskripsi_C6 = $dC6->deskripsi;
            $foto_C6 = $dC6->foto;
        }

        $data_C1 = $this->M_barang->ambildataid($C1);

        $data_pelanggan = $this->M_pelanggan->ambilpelanggan($id_pelanggan);

        foreach ($data_pelanggan as $dp) {
            $email = $dp->email;
        }

        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'jayabatola@gmail.com',
            'smtp_pass' => 'fzfphimgtpohwljo',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'chartset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->initialize($config);
        $this->email->from('jayabatola@gmail.com', 'Admin');
        $this->email->to($email);


        $this->email->subject('Diskon ' . $namatoko . ' Untuk Anda');

        $message = '<td align="center" style="background-color:#eaeaea;margin-top:0" bgcolor="#eaeaea">
        <table align="center" border="0" class="m_2227710512858423413content" cellpadding="0" cellspacing="0"
            style="background-color:#ffffff;width:500px" width="500" bgcolor="#ffffff">
            <tbody>
                <tr>
                    <td>
                        <table class="m_2227710512858423413image" width="100%" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td class="m_2227710512858423413cell m_2227710512858423413content-padding"
                                        align="center" style="padding-left:20px;padding-right:20px;padding-top:0"><img
                                            src="https://ci3.googleusercontent.com/meips/ADKq_NbD_WZx4BDNgYFoEQPx6hfVg9fR9iSTwV-xFOgSNPyHWS_VaAFEOI1dWCukMflQmrV-xf4nbt7H3oH1iP73_UCZ-mPPmNVUO5Uo0SBa3KoP59slpVVFlU38fr4EM985yEqcJI9_CZG610zx1DnsKn6FaaLJSZtE2kduiUqVAiyQtyt9FUPmWQ7qmrSM-7Flh9_1WMbVU6tIIvYm9DT-_OoQ8CUYQ8n8zvb4eEif5o1XQ6mj3hKosvBPmS8doC9c8MU8yJbXqcjMwMkLLfkEDbbVKmSEhEjGyk1yKoRGtwn21vVut2oujQhbvBowmKIUbtUJnS8fvF2YA_o-81JveY7gZIT6b7qpXvqdoUVTFPERKAVj2tHmBnOha5DPKd-lu5qVEhcELKCtatk_ktl48b_Ht60SXAlpq-0pVgxFANvFRvkwA6ZTHbNmLeRm3nfLf-d3335qG1xHlGnUCJ0ycBQAX1eMxaBmn-7I9KKVc9a5aM20hdm65tq8i1oN6a3VXMkKR14mwpICU-z84DcnwDzRfqSG2D9cAv5g77yGFHPt3puLabA_yYhukCLCXictQCspUfeBEepM1E3-Of1erceXKRYY61UXio8QB6U6BHVqGK1mn_7jJ_dESMQujmbfKKUr2ggqWtXKXaRqA_vK3YCLQrVGJkTiy_sfDSRdhRpsJcwFdp__UJ4OFu3Qg65QD5Nob9mEHKeutO-VDWWjqCkbmC4wKOl4X4pe-tSlICcXIP3-lOckKkipiezyORCKK1-qD4dD6t298Q=s0-d-e1-ft#https://beaconimages.netflix.net/img/BAQgBEAEagAN2THSsgosiINnMMOKPnivWLqJPSwxtlVioMt-kX_SIVcTIIV0_oEfOgHxzwsQntjRlHHSCMHiVtffdPuUt-s4oQIrniqMEDR06Q2Oz-LbPJTvcWRtQhxJN-kGsC7yY5OrEZvsyiZ6pv3PJtOyZ4S7gAKM-uE2E2akD74IrC1NPq71uHwrwfHJslSB4M3WNfLNTo5clS4JdxOAr51NPLLA-632v5u9vVO5kHnJsgNyTwDvbOY1iea8eKle8EQiHrIEo-4Ce5YCMGDC4LXPAAdlsUADLLcwUudBqn4EdK4fd4nHuQDAkYNVkV_VEX3w1KkHFK-GhC1bjDg5cgNWjeAcTCzSJMwDTJWZxaaG_y9WXNj9zqywIZJaOrUwvNqorM4l2JTmyWtTyqXMviB1A8y_xmmuL92Vy3TlvfN-_qQsbF9FVrVnSkBLmNouE18h6Y3fyYLfgTQkbhSQohKLVhw6GtpTHwx07iamvDlesPGHQk7vNOpGT9gS_5aRw4mKyFUU."
                                            alt="" width="0" border="0"
                                            style="border:none;outline:none;border-collapse:collapse;display:block"
                                            class="CToWUd" data-bit="iit"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center"><a
                            href="https://www.netflix.com/browse?g=0e7df4ba-5eed-41f5-9336-1b6ff1d1d251&amp;lkid=URL_LOGO&amp;lnktrk=EVO"
                            style="color:inherit" target="_blank"
                            data-saferedirecturl="https://www.google.com/url?q=https://www.netflix.com/browse?g%3D0e7df4ba-5eed-41f5-9336-1b6ff1d1d251%26lkid%3DURL_LOGO%26lnktrk%3DEVO&amp;source=gmail&amp;ust=1713880278489000&amp;usg=AOvVaw2_tFrMlF_EZl8dWpeFTqeG">
                            <table class="m_2227710512858423413image" width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td class="m_2227710512858423413cell m_2227710512858423413content-padding"
                                            align="left" style="padding-left:20px;padding-right:20px;padding-top:20px"><img
                                                src="https://firebasestorage.googleapis.com/v0/b/ptoko-3a70f.appspot.com/o/bg.png?alt=media&token=f268c007-c0c6-4388-8bfa-e1a81a767fd2"
                                                alt="Netflix" width="150" border="0"
                                                style="border:none;outline:none;border-collapse:collapse;display:block;border-style:none"
                                                class="CToWUd" data-bit="iit"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </a>
                        <table align="left" width="100%" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td align="left" class="m_2227710512858423413content-padding"
                                        style="padding-left:20px;padding-right:20px;font-family:NetflixSans-Bold,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:700;font-size:36px;line-height:43px;letter-spacing:-1px;padding-top:20px;color:#221f1f">
                                        Pelanggan yang terhormat.</td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="left" width="100%" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td align="left" class="m_2227710512858423413content-padding"
                                        style="padding-left:20px;padding-right:20px;font-family:NetflixSans-Regular,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:400;font-size:16px;line-height:21px;padding-top:20px;color:#221f1f">
                                        Hai,</td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="left" width="100%" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td align="left" class="m_2227710512858423413content-padding"
                                        style="padding-left:20px;padding-right:20px;font-family:NetflixSans-Regular,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:400;font-size:16px;line-height:21px;padding-top:20px;color:#221f1f">
                                        Kami ingin merekomendasikan beberapa produk
                                        terbaik yang mungkin sesuai dengan kebutuhan dan
                                        preferensi Anda. Kami harap Anda menemukan produk
                                        yang kami rekomendasikan ini sesuai dengan apa yang
                                        Anda cari: <b
                                            style="font-family:NetflixSans-Bold,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:700">
                                            dapatkan kebutuhan anda dengan harga terbaik</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="left" width="100%" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td align="left" class="m_2227710512858423413content-padding"
                                        style="padding-left:20px;padding-right:20px;font-family:NetflixSans-Regular,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:400;font-size:16px;line-height:21px;padding-top:20px;color:#221f1f">
                                        <b
                                            style="font-family:NetflixSans-Bold,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:700">Rekomendasi untuk anda :
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="width:30rem;overflow-x:auto;white-space:nowrap">
                            <div
                                style="display:inline-block;width:200px;height:350px;background-color:#f0f0f0;margin:10px;border-radius:10px">
                                <div style="padding:20px">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/ptoko-3a70f.appspot.com/o/images%2F' . $foto_C1 . '?alt=media&token"
                                        alt="" style="max-width: 10rem; max-height: 10rem;    border-radius:10px 10px 0 0;">
                                    <h3 style="margin-top:0">' . $nama_barang_C1 . '
                                    </h3>
                                    <p style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">' . $deskripsi_C1 . '</p>
                                    <p>Harga: Rp ' . number_format($harga_C1, 0, ',', '.') . ',-</p>
                                 
                                </div>
                            </div>
                            <div
                                style="display:inline-block;width:200px;height:350px;background-color:#f0f0f0;margin:10px;border-radius:10px">
                                <div style="padding:20px">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/ptoko-3a70f.appspot.com/o/images%2F' . $foto_C2 . '?alt=media&token"
                                        alt="" style="max-width: 10rem; max-height: 10rem;    border-radius:10px 10px 0 0;">
                                    <h3 style="margin-top:0">' . $nama_barang_C2 . '
                                    </h3>
                                    <p style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">' . $deskripsi_C2 . '</p>
                                    <p>Harga: Rp ' . number_format($harga_C2, 0, ',', '.') . ',-</p>
                                 
                                </div>
                            </div>
                            <div
                                style="display:inline-block;width:200px;height:350px;background-color:#f0f0f0;margin:10px;border-radius:10px">
                                <div style="padding:20px">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/ptoko-3a70f.appspot.com/o/images%2F' . $foto_C3 . '?alt=media&token"
                                        alt="" style="max-width: 10rem; max-height: 10rem;    border-radius:10px 10px 0 0;">
                                    <h3 style="margin-top:0">' . $nama_barang_C3 . '
                                    </h3>
                                    <p style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">' . $deskripsi_C3 . '</p>
                                    <p>Harga: Rp ' . number_format($harga_C3, 0, ',', '.') . ',-</p>
                                   
                                </div>
                            </div>
                            <div
                                style="display:inline-block;width:200px;height:350px;background-color:#f0f0f0;margin:10px;border-radius:10px">
                                <div style="padding:20px">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/ptoko-3a70f.appspot.com/o/images%2F' . $foto_C4 . '?alt=media&token"
                                        alt="" style="max-width: 10rem; max-height: 10rem;    border-radius:10px 10px 0 0;">
                                    <h3 style="margin-top:0">' . $nama_barang_C4 . '
                                    </h3>
                                    <p style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">' . $deskripsi_C4 . '</p>
                                    <p>Harga: Rp ' . number_format($harga_C4, 0, ',', '.') . ',-</p>
                                    
                                </div>
                            </div>
                            <div
                                style="display:inline-block;width:200px;height:350px;background-color:#f0f0f0;margin:10px;border-radius:10px">
                                <div style="padding:20px">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/ptoko-3a70f.appspot.com/o/images%2F' . $foto_C5 . '?alt=media&token"
                                        alt="" style="max-width: 10rem; max-height: 10rem;    border-radius:10px 10px 0 0;">
                                    <h3 style="margin-top:0">' . $nama_barang_C5 . '
                                    </h3>
                                    <p style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">' . $deskripsi_C5 . '</p>
                                    <p>Harga: Rp ' . number_format($harga_C5, 0, ',', '.') . ',-</p>
                                   
                                </div>
                            </div>
                            <div
                                style="display:inline-block;width:200px;height:350px;background-color:#f0f0f0;margin:10px;border-radius:10px">
                                <div style="padding:20px">
                                    <img src="https://firebasestorage.googleapis.com/v0/b/ptoko-3a70f.appspot.com/o/images%2F' . $foto_C6 . '?alt=media&token"
                                        alt="" style="max-width: 10rem; max-height: 10rem;    border-radius:10px 10px 0 0;">
                                    <h3 style="margin-top:0">' . $nama_barang_C6 . '
                                    </h3>
                                    <p style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">' . $deskripsi_C6 . '</p>
                                    <p>Harga: Rp ' . number_format($harga_C6, 0, ',', '.') . ',-</p>
                                    
                                </div>
                            </div>
    
                        </div>
    
    
    
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td class="m_2227710512858423413content-padding"
                                        style="padding-left:20px;padding-right:20px;padding-top:30px">
                                        <table align="center" width="100%" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td
                                                        style="font-size:0;line-height:0;border-style:solid;border-bottom-width:0;border-color:#221f1f;border-top-width:2px">
                                                        &nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" class="m_2227710512858423413footer-shell" style="background-color:#ffffff"
                        bgcolor="#ffffff">
                        <table class="m_2227710512858423413footer" width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td align="center" valign="top"
                                        class="m_2227710512858423413footer-shell m_2227710512858423413content-padding"
                                        style="padding-left:20px;padding-right:20px;background-color:#ffffff"
                                        bgcolor="#ffffff">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td style="font-size:0;line-height:0;height:40px" height="40">&nbsp;
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" style="padding:0 20px 0 0">
                                                        <table
                                                            class="m_2227710512858423413component-image m_2227710512858423413image"
                                                            width="100%" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="m_2227710512858423413cell m_2227710512858423413component-image"
                                                                        align="center" style="padding-top:0"><img
                                                                            src="https://firebasestorage.googleapis.com/v0/b/ptoko-3a70f.appspot.com/o/bg.png?alt=media&token=f268c007-c0c6-4388-8bfa-e1a81a767fd2"
                                                                            alt="" width="120" border="0"
                                                                            style="border:none;outline:none;border-collapse:collapse;display:block"
                                                                            class="CToWUd" data-bit="iit"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td valign="top">
                                                        <table width="100%" valign="top" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <table align="left" width="100%" cellpadding="0"
                                                                            cellspacing="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        style="font-family:NetflixSans-Regular,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:400;font-size:14px;line-height:18px;letter-spacing:-0.25px;color:#a4a4a4;padding-top:0">
                                                                                        <span>Kontak? Hubungi
                                                                                            ' . $notoko . '</span>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table align="left" width="100%" cellpadding="0"
                                                                            cellspacing="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        style="font-family:NetflixSans-Regular,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:400;font-size:11px;line-height:14px;letter-spacing:-0.1px;color:#a4a4a4;padding-top:0">
                                                                                        <span
                                                                                            class="m_2227710512858423413hide-link"
                                                                                            style="text-decoration:none"><a
                                                                                                href="https://help.netflix.com/legal/corpinfo?g=0e7df4ba-5eed-41f5-9336-1b6ff1d1d251&amp;lkid=URL_CORP_INFO&amp;lnktrk=EVO"
                                                                                                style="color:#a4a4a4;text-decoration:none"
                                                                                                target="_blank"
                                                                                                data-saferedirecturl="https://www.google.com/url?q=https://help.netflix.com/legal/corpinfo?g%3D0e7df4ba-5eed-41f5-9336-1b6ff1d1d251%26lkid%3DURL_CORP_INFO%26lnktrk%3DEVO&amp;source=gmail&amp;ust=1713880278489000&amp;usg=AOvVaw2YOR2kienriCAIMcnHVXF7"><span><span
                                                                                                        class="il">-</span>
                                                                                                    ' . $namatoko . '
                                                                                                </span></a></span>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table align="left" width="100%" cellpadding="0"
                                                                            cellspacing="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        style="font-family:NetflixSans-Regular,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:400;font-size:12px;line-height:15px;letter-spacing:-0.12px;padding-top:20px;color:#a9a6a6">
                                                                                        <span>' . $alamattoko . '</span>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
    
                                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="font-size:0;line-height:0;height:40px"
                                                                                        height="40">&nbsp;</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        </td>';
        $info = $this->email->message($message);


        if ($this->email->send()) {
            echo json_encode($info);
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function kirimRekomendasiBarang()
    {
        $barang1 = $this->input->post('barang1');
        $barang2 = $this->input->post('barang2');
        $barang3 = $this->input->post('barang3');

        $keterangan1 = $this->input->post('keterangan1');
        $keterangan2 = $this->input->post('keterangan2');
        $keterangan3 = $this->input->post('keterangan3');


        $data_C1 = $this->M_barang->ambildataid($barang1);

        foreach ($data_C1 as $dC1) {
            $nama_barang_C1 = $dC1->nama_barang;
            $harga_C1 = $dC1->harga;
            $deskripsi_C1 = $dC1->deskripsi;
            $foto_C1 = $dC1->foto;
        }
        //ctrl z sammpai sini
        if ($barang2 != NULL) {
            $data_C2 = $this->M_barang->ambildataid($barang2);

            foreach ($data_C2 as $dC2) {
                $nama_barang_C2 = $dC2->nama_barang;
                $harga_C2 = $dC2->harga;
                $deskripsi_C2 = $dC2->deskripsi;
                $foto_C2 = $dC2->foto;
            }
        }

        if ($barang3 != NULL) {
            $data_C3 = $this->M_barang->ambildataid($barang3);

            foreach ($data_C3 as $dC3) {
                $nama_barang_C3 = $dC3->nama_barang;
                $harga_C3 = $dC3->harga;
                $deskripsi_C3 = $dC3->deskripsi;
                $foto_C3 = $dC3->foto;
            }
        }

        $ambilSaw = $this->M_saw->ambildata(NULL);

        foreach ($ambilSaw as $as) {
            $pelanggan = $this->M_pelanggan->ambilpelanggan($as->id_user);

            foreach ($pelanggan as $pl) {
                $email = $pl->email;
            }
            $cek1 = $this->M_saw->cariBarangRekomendasi($barang1, $as->id_user);
            if ($barang2 != NULL) {
                $cek2 = $this->M_saw->cariBarangRekomendasi($barang2, $as->id_user);
            } else {
                $cek2 = NULL;
            }
            if ($barang3 != NULL) {
                $cek3 = $this->M_saw->cariBarangRekomendasi($barang3, $as->id_user);
            } else {
                $cek2 = NULL;
            }

            if ($cek1 == 1) {
                $rekomendasi1 = '<div
                style="display:inline-block;width:200px;height:350px;background-color:#f0f0f0;margin:10px;border-radius:10px">
                <div style="padding:20px">
                <div style="background-color: #C1FFB6; border-top-left-radius: 2rem; border-top-right-radius: 2rem;">' . $keterangan1 . '</div>
                    <img src="https://firebasestorage.googleapis.com/v0/b/ptoko-3a70f.appspot.com/o/images%2F' . $foto_C1 . '?alt=media&token"
                        alt="" style="max-width: 10rem; max-height: 10rem;    border-radius:10px 10px 0 0;">
                    <h3 style="margin-top:0">' . $nama_barang_C1 . '
                    </h3>
                    <p style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">' . $deskripsi_C1 . '</p>
                    <p>Harga: Rp ' . number_format($harga_C1, 0, ',', '.') . ',-</p>
                    
                </div>
            </div>';
            } else {
                $rekomendasi1 = '';
            }
            if ($cek2 == 1) {
                $rekomendasi2 = '<div
                style="display:inline-block;width:200px;height:350px;background-color:#f0f0f0;margin:10px;border-radius:10px">
                <div style="padding:20px">
                <div style="background-color: #C1FFB6; border-top-left-radius: 2rem; border-top-right-radius: 2rem;">' . $keterangan2 . '</div>
                    <img src="https://firebasestorage.googleapis.com/v0/b/ptoko-3a70f.appspot.com/o/images%2F' . $foto_C2 . '?alt=media&token"
                        alt="" style="max-width: 10rem; max-height: 10rem;    border-radius:10px 10px 0 0;">
                    <h3 style="margin-top:0">' . $nama_barang_C2 . '
                    </h3>
                    <p style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">' . $deskripsi_C2 . '</p>
                    <p>Harga: Rp ' . number_format($harga_C2, 0, ',', '.') . ',-</p>
                    
                </div>
            </div>';
            } else {
                $rekomendasi2 = '';
            }
            if ($cek3 == 1) {
                $rekomendasi3 = '<div
                style="display:inline-block;width:200px;height:350px;background-color:#f0f0f0;margin:10px;border-radius:10px">
                <div style="padding:20px">
                <div style="background-color: #C1FFB6; border-top-left-radius: 2rem; border-top-right-radius: 2rem;">' . $keterangan3 . '</div>
                    <img src="https://firebasestorage.googleapis.com/v0/b/ptoko-3a70f.appspot.com/o/images%2F' . $foto_C3 . '?alt=media&token"
                        alt="" style="max-width: 10rem; max-height: 10rem;    border-radius:10px 10px 0 0;">
                    <h3 style="margin-top:0">' . $nama_barang_C3 . '
                    </h3>
                    <p style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">' . $deskripsi_C2 . '</p>
                    <p>Harga: Rp ' . number_format($harga_C3, 0, ',', '.') . ',-</p>
               
                </div>
            </div>';
            } else {
                $rekomendasi3 = '';
            }


            $config = [
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'jayabatola@gmail.com',
                'smtp_pass' => 'fzfphimgtpohwljo',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'chartset' => 'utf-8',
                'newline' => "\r\n"
            ];

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->initialize($config);
            $this->email->from('jayabatola@gmail.com', 'Batola');
            $this->email->to($email);


            $this->email->subject('Diskon Batola Untuk Anda');

            $message = '<td align="center" style="background-color:#eaeaea;margin-top:0" bgcolor="#eaeaea">
            <table align="center" border="0" class="m_2227710512858423413content" cellpadding="0" cellspacing="0"
                style="background-color:#ffffff;width:500px" width="500" bgcolor="#ffffff">
                <tbody>
                    <tr>
                        <td>
                            <table class="m_2227710512858423413image" width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td class="m_2227710512858423413cell m_2227710512858423413content-padding"
                                            align="center" style="padding-left:20px;padding-right:20px;padding-top:0"><img
                                                src="https://ci3.googleusercontent.com/meips/ADKq_NbD_WZx4BDNgYFoEQPx6hfVg9fR9iSTwV-xFOgSNPyHWS_VaAFEOI1dWCukMflQmrV-xf4nbt7H3oH1iP73_UCZ-mPPmNVUO5Uo0SBa3KoP59slpVVFlU38fr4EM985yEqcJI9_CZG610zx1DnsKn6FaaLJSZtE2kduiUqVAiyQtyt9FUPmWQ7qmrSM-7Flh9_1WMbVU6tIIvYm9DT-_OoQ8CUYQ8n8zvb4eEif5o1XQ6mj3hKosvBPmS8doC9c8MU8yJbXqcjMwMkLLfkEDbbVKmSEhEjGyk1yKoRGtwn21vVut2oujQhbvBowmKIUbtUJnS8fvF2YA_o-81JveY7gZIT6b7qpXvqdoUVTFPERKAVj2tHmBnOha5DPKd-lu5qVEhcELKCtatk_ktl48b_Ht60SXAlpq-0pVgxFANvFRvkwA6ZTHbNmLeRm3nfLf-d3335qG1xHlGnUCJ0ycBQAX1eMxaBmn-7I9KKVc9a5aM20hdm65tq8i1oN6a3VXMkKR14mwpICU-z84DcnwDzRfqSG2D9cAv5g77yGFHPt3puLabA_yYhukCLCXictQCspUfeBEepM1E3-Of1erceXKRYY61UXio8QB6U6BHVqGK1mn_7jJ_dESMQujmbfKKUr2ggqWtXKXaRqA_vK3YCLQrVGJkTiy_sfDSRdhRpsJcwFdp__UJ4OFu3Qg65QD5Nob9mEHKeutO-VDWWjqCkbmC4wKOl4X4pe-tSlICcXIP3-lOckKkipiezyORCKK1-qD4dD6t298Q=s0-d-e1-ft#https://beaconimages.netflix.net/img/BAQgBEAEagAN2THSsgosiINnMMOKPnivWLqJPSwxtlVioMt-kX_SIVcTIIV0_oEfOgHxzwsQntjRlHHSCMHiVtffdPuUt-s4oQIrniqMEDR06Q2Oz-LbPJTvcWRtQhxJN-kGsC7yY5OrEZvsyiZ6pv3PJtOyZ4S7gAKM-uE2E2akD74IrC1NPq71uHwrwfHJslSB4M3WNfLNTo5clS4JdxOAr51NPLLA-632v5u9vVO5kHnJsgNyTwDvbOY1iea8eKle8EQiHrIEo-4Ce5YCMGDC4LXPAAdlsUADLLcwUudBqn4EdK4fd4nHuQDAkYNVkV_VEX3w1KkHFK-GhC1bjDg5cgNWjeAcTCzSJMwDTJWZxaaG_y9WXNj9zqywIZJaOrUwvNqorM4l2JTmyWtTyqXMviB1A8y_xmmuL92Vy3TlvfN-_qQsbF9FVrVnSkBLmNouE18h6Y3fyYLfgTQkbhSQohKLVhw6GtpTHwx07iamvDlesPGHQk7vNOpGT9gS_5aRw4mKyFUU."
                                                alt="" width="0" border="0"
                                                style="border:none;outline:none;border-collapse:collapse;display:block"
                                                class="CToWUd" data-bit="iit"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><a
                                href="https://www.netflix.com/browse?g=0e7df4ba-5eed-41f5-9336-1b6ff1d1d251&amp;lkid=URL_LOGO&amp;lnktrk=EVO"
                                style="color:inherit" target="_blank"
                                data-saferedirecturl="https://www.google.com/url?q=https://www.netflix.com/browse?g%3D0e7df4ba-5eed-41f5-9336-1b6ff1d1d251%26lkid%3DURL_LOGO%26lnktrk%3DEVO&amp;source=gmail&amp;ust=1713880278489000&amp;usg=AOvVaw2_tFrMlF_EZl8dWpeFTqeG">
                                <table class="m_2227710512858423413image" width="100%" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td class="m_2227710512858423413cell m_2227710512858423413content-padding"
                                                align="left" style="padding-left:20px;padding-right:20px;padding-top:20px"><img
                                                    src="https://firebasestorage.googleapis.com/v0/b/ptoko-3a70f.appspot.com/o/batolanobg.png?alt=media&token=f268c007-c0c6-4388-8bfa-e1a81a767fd2"
                                                    alt="Netflix" width="150" border="0"
                                                    style="border:none;outline:none;border-collapse:collapse;display:block;border-style:none"
                                                    class="CToWUd" data-bit="iit"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </a>
                            <table align="left" width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="left" class="m_2227710512858423413content-padding"
                                            style="padding-left:20px;padding-right:20px;font-family:NetflixSans-Bold,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:700;font-size:36px;line-height:43px;letter-spacing:-1px;padding-top:20px;color:#221f1f">
                                            Pelanggan yang terhormat.</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table align="left" width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="left" class="m_2227710512858423413content-padding"
                                            style="padding-left:20px;padding-right:20px;font-family:NetflixSans-Regular,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:400;font-size:16px;line-height:21px;padding-top:20px;color:#221f1f">
                                            Hai,</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table align="left" width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="left" class="m_2227710512858423413content-padding"
                                            style="padding-left:20px;padding-right:20px;font-family:NetflixSans-Regular,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:400;font-size:16px;line-height:21px;padding-top:20px;color:#221f1f">
                                            Kami ingin merekomendasikan beberapa produk
                                            terbaik yang mungkin sesuai dengan kebutuhan dan
                                            preferensi Anda. Kami harap Anda menemukan produk
                                            yang kami rekomendasikan ini sesuai dengan apa yang
                                            Anda cari: <b
                                                style="font-family:NetflixSans-Bold,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:700">
                                                dapatkan kebutuhan anda dengan harga terbaik</b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table align="left" width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="left" class="m_2227710512858423413content-padding"
                                            style="padding-left:20px;padding-right:20px;font-family:NetflixSans-Regular,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:400;font-size:16px;line-height:21px;padding-top:20px;color:#221f1f">
                                            <b
                                                style="font-family:NetflixSans-Bold,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:700">Rekomendasi untuk anda :
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div style="width:30rem;overflow-x:auto;white-space:nowrap">
                                ' . $rekomendasi1 . '
                                ' . $rekomendasi2 . '
                                ' . $rekomendasi3 . '
                              
                            
                            </div>
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td class="m_2227710512858423413content-padding"
                                            style="padding-left:20px;padding-right:20px;padding-top:30px">
                                            <table align="center" width="100%" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td
                                                            style="font-size:0;line-height:0;border-style:solid;border-bottom-width:0;border-color:#221f1f;border-top-width:2px">
                                                            &nbsp;</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" class="m_2227710512858423413footer-shell" style="background-color:#ffffff"
                            bgcolor="#ffffff">
                            <table class="m_2227710512858423413footer" width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="center" valign="top"
                                            class="m_2227710512858423413footer-shell m_2227710512858423413content-padding"
                                            style="padding-left:20px;padding-right:20px;background-color:#ffffff"
                                            bgcolor="#ffffff">
                                            <table width="100%" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size:0;line-height:0;height:40px" height="40">&nbsp;
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table width="100%" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" style="padding:0 20px 0 0">
                                                            <table
                                                                class="m_2227710512858423413component-image m_2227710512858423413image"
                                                                width="100%" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="m_2227710512858423413cell m_2227710512858423413component-image"
                                                                            align="center" style="padding-top:0"><img
                                                                                src="https://firebasestorage.googleapis.com/v0/b/ptoko-3a70f.appspot.com/o/batolanobg.png?alt=media&token=f268c007-c0c6-4388-8bfa-e1a81a767fd2"
                                                                                alt="" width="120" border="0"
                                                                                style="border:none;outline:none;border-collapse:collapse;display:block"
                                                                                class="CToWUd" data-bit="iit"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td valign="top">
                                                            <table width="100%" valign="top" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <table align="left" width="100%" cellpadding="0"
                                                                                cellspacing="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left"
                                                                                            style="font-family:NetflixSans-Regular,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:400;font-size:14px;line-height:18px;letter-spacing:-0.25px;color:#a4a4a4;padding-top:0">
                                                                                            <span>Kontak? Hubungi
                                                                                                0813-3032-5745</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table align="left" width="100%" cellpadding="0"
                                                                                cellspacing="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left"
                                                                                            style="font-family:NetflixSans-Regular,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:400;font-size:11px;line-height:14px;letter-spacing:-0.1px;color:#a4a4a4;padding-top:0">
                                                                                            <span
                                                                                                class="m_2227710512858423413hide-link"
                                                                                                style="text-decoration:none"><a
                                                                                                    href="https://help.netflix.com/legal/corpinfo?g=0e7df4ba-5eed-41f5-9336-1b6ff1d1d251&amp;lkid=URL_CORP_INFO&amp;lnktrk=EVO"
                                                                                                    style="color:#a4a4a4;text-decoration:none"
                                                                                                    target="_blank"
                                                                                                    data-saferedirecturl="https://www.google.com/url?q=https://help.netflix.com/legal/corpinfo?g%3D0e7df4ba-5eed-41f5-9336-1b6ff1d1d251%26lkid%3DURL_CORP_INFO%26lnktrk%3DEVO&amp;source=gmail&amp;ust=1713880278489000&amp;usg=AOvVaw2YOR2kienriCAIMcnHVXF7"><span><span
                                                                                                            class="il">CV.</span>
                                                                                                        Batola Jaya
                                                                                                    </span></a></span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table align="left" width="100%" cellpadding="0"
                                                                                cellspacing="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left"
                                                                                            style="font-family:NetflixSans-Regular,Helvetica,Roboto,Segoe UI,sans-serif;font-weight:400;font-size:12px;line-height:15px;letter-spacing:-0.12px;padding-top:20px;color:#a9a6a6">
                                                                                            <span>Perum Graha Kembangan Asri,
                                                                                                Jl. Raya Kembangan Asri No.1,
                                                                                                Gn. Malang, Kembangan, Kec.
                                                                                                Kebomas, Kabupaten Gresik, Jawa
                                                                                                Timur 61121</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
        
                                                                            <table width="100%" cellpadding="0" cellspacing="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td style="font-size:0;line-height:0;height:40px"
                                                                                            height="40">&nbsp;</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </td>';

            $info = $this->email->message($message);
            if ($this->email->send()) {
                echo json_encode(True);
            } else {
                echo $this->email->print_debugger();
                die;
            }
        }
    }
}
