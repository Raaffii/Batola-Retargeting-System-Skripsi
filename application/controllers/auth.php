<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation', 'session');
        $this->load->model('M_auth');
    }

    public function index()
    {
        $this->form_validation->set_rules('emailorusername', 'Emailorusername', 'required|trim', ['required' => 'Username atau Email harus Diisi !']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password Harus Diisi !']);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', 'Email, Username, atau Password salah!');
            $this->template->load('auth/template', 'auth/V_login');
        } else {

            $this->_login();
        }
    }

    private function _login()
    {
        $emailorusername = $this->input->post('emailorusername');
        $password = $this->input->post('password');
        $akun = $this->M_auth->login($emailorusername);

        if (!$akun) {
            $this->session->set_flashdata('salah2', 'Email, Username, atau Password salah!');
            $this->template->load('auth/template', 'auth/V_login');
        } else {
            if (password_verify($password, $akun['password'])) {
                $data = [
                    'username' => $akun['username'],
                    'level' => $akun['level'],

                ];
                $this->session->set_userdata($data);
                if ($akun['level'] == 1) {
                    redirect('transaksi/pembelian');
                } else {
                    redirect('barang');
                }
            } else {
                $this->session->set_flashdata('salah', 'Email, Username, atau Password salah!');
                $this->template->load('auth/template', 'auth/V_login');
            }
        }
    }



    public function register()
    {
        $this->form_validation->set_rules(
            'name',
            'Name',
            'required|trim',
            ['required' => 'Nama Harus Diisi !']
        );

        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|trim|is_unique[tb_user.username]',
            [
                'required' => 'Username Harus Diisi !',
                'is_unique' => 'Username Ini Telah Terdaftar !'
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[5]',
            [
                'required' => 'Password Wajib Diisi !',
                'min_length' => 'Password Terlalu Pendek !'
            ]
        );
        $this->form_validation->set_rules(
            'password2',
            'Konfirmasi Password',
            'required|trim|min_length[5]|matches[password1]',
            [
                'required' => 'Konfirmasi Password Wajib Diisi !',
                'matches' => 'Konfirmasi Password Harus Sama !',
                'min_length' => 'Password Terlalu Pendek !'
            ]
        );
        if ($this->form_validation->run() == false) {
            $this->template->load('auth/template', 'auth/V_register');
        } else {
            $username = $this->input->post('username', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'username' => htmlspecialchars($username),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'level' => 1,
                'date_created' => date("Y-m-d H:i:s")

            ];
            $this->db->insert('tb_user', $data);
            $this->session->set_flashdata('notif', 'Barang berhasil masuk');
            redirect('barang');
        }
    }

    public function notFound()
    {
        $this->template->load('auth/template', 'auth/V_notFound');
    }
    public function accesDenied()
    {
        $this->template->load('auth/template', 'auth/V_accesDenied');
    }

    public function logout()
    {
        $this->session->unset_userdata(array('username', 'level'));
        $this->session->set_flashdata('notif', 'Berhasil Logout');
        redirect("auth");
    }
}
