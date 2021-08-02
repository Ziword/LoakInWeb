<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CHome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (is_null($_SESSION['id_admin'])) {
            $this->session->set_flashdata('perluLogin', 'true');
            redirect(site_url('Clogin'));
        }
    }

    public function index()
    {
        $data['judul'] = "Dashboard";
        $this->load->view('templates/header', $data);
        $this->load->view('mdm/dashboard', $data);
        $this->load->view('templates/footer');
    }
}
