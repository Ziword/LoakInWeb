<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CLogin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelAdmin');
    }

    public function index()
    {
        if (isset($_SESSION['logged_in'])) {
            redirect(site_url('Chome'));
        }
        $this->load->view('login_page/auth_signin');
    }

    public function cek()
    {
        $username = strtolower($this->input->post_get('username', TRUE));
        $password = $this->input->post_get('password', TRUE);

        $cekLogin = $this->ModelAdmin->doLogin($username, $password);

        if ($cekLogin == true) {
            $dataUser = $this->ModelAdmin->getDataUser($username);
            $newdata = array(
                'id_admin'  => $dataUser['ID_ADMIN'],
                'nama_admin' => $dataUser['NAMA_ADMIN'],
                'logged_in' => TRUE
            );

            $this->session->set_userdata($newdata);
            redirect(site_url('Chome'));
        } else {
            $this->session->set_flashdata('loginGagal', 'true');
            redirect(site_url('Clogin'));
        }
    }

    public function logout()
    {
        // hancurkan semua sesi
        $this->session->sess_destroy();
        redirect(site_url('Clogin'));
    }
}
