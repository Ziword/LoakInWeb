<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControllerMDT extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelMDTransaksiAgenBaru');

        if (is_null($_SESSION['id_admin'])) {
            $this->session->set_flashdata('perluLogin', 'true');
            redirect(site_url('Clogin'));
        }
    }

    public function indexAgenBaru()
    {
        $data['judul'] = "Pendaftaran";
        $this->load->view('templates/header', $data);
        $this->load->view('pendaftaran/agen_baru/v_agen_baru', $data);
        $this->load->view('templates/footer');
    }

    public function getDataAgen()
    {
        if ($this->input->post()) {
            $results = $this->modelMDTransaksiAgenBaru->getDataTable();
            $data = [];
            foreach ($results as $result) {
                $linkLokasi = "$result->LATITUDE,$result->LONGTITUDE";
                $dokumenDaftar = "$result->DOKUMEN_DAFTAR_AGEN";
                $row = array();
                $row[] = $result->ID_AGEN;
                $row[] = $result->NAMA_AGEN;
                $row[] = $result->EMAIL_AGEN;
                $row[] = $result->NO_TELP_AGEN;
                $row[] = $result->ALAMAT_LENGKAP_AGEN;
                $row[] = "<button type='button' class='btn btn-success btn-sm' onclick='openLokasi($linkLokasi)'>Lokasi</button>";
                $row[] = "<button type='button' class='btn btn-success btn-sm' value='" . $dokumenDaftar . ".pdf" . "' onclick='openFile(this.value)'>Dokumen Agen</button>";
                $row[] = "<button type='button' class='btn btn-success btn-sm' value='$result->ID_AGEN' onclick='editData(this.value)'>Edit</button>";
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST["draw"],
                "recordsTotal" => $this->modelMDTransaksiAgenBaru->count_all_data(),
                "recordsFiltered" => $this->modelMDTransaksiAgenBaru->count_filtered_data(),
                "data" => $data,
            );
            $this->output->set_content_type("application/json")->set_output(json_encode($output));
        }
    }

    public function fetchAgen()
    {
        if ($this->input->post('id_agen')) {
            $dtilAgen = $this->modelMDTransaksiAgenBaru->getDataAgen($this->input->post('id_agen'));
            echo json_encode($dtilAgen);
        } else {
            redirect(site_url('ControllerMDT/indexAgenBaru'));
        }
    }

    public function tambahAgenBaru()
    {
        if ($this->input->post('nama_agen')) {
            $file_name = str_replace(' ', '', $this->input->post('nama_agen')); // Replaces all spaces with hyphens.
            $file_name = preg_replace('/[^A-Za-z0-9\-]/', '', $file_name) . "FileDokumen"; // Removes special chars.

            //INISIALISASI KONFIGURASI FILE UPLOAD
            $config['upload_path']          = './storage/uploads/dokumen_pendaftar/agen';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 4096;
            $config['file_name']            = $file_name;
            $config['overwrite']            = true;

            $this->load->library('upload');
            $this->upload->initialize($config);

            $nama_agen = $this->input->post('nama_agen');
            $email_agen = $this->input->post('email_agen');
            $telpon_agen = $this->input->post('telpon_agen');
            $alamat_agen = $this->input->post('alamat_agen');
            $lat_agen = $this->input->post('lat_agen');
            $lan_agen = $this->input->post('lan_agen');

            if (!$this->upload->do_upload('fileDokumen')) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                $this->session->set_flashdata('tambahBerhasil', 'false');
                redirect(site_url('ControllerMDT/indexAgenBaru'));
            }

            $this->modelMDTransaksiAgenBaru->tambahDataAgen($nama_agen, $email_agen, $telpon_agen, $alamat_agen, $lat_agen, $lan_agen, $file_name);
            $this->session->set_flashdata('tambahBerhasil', 'true');
            redirect(site_url('ControllerMDT/indexAgenBaru'));
        } else {
            $this->session->set_flashdata('tambahBerhasil', 'false');
            redirect(site_url('ControllerMDT/indexAgenBaru'));
        }
    }

    public function editAgen()
    {
        if ($this->input->post('id_agen')) {
            $file_name = str_replace(' ', '', $this->input->post('nama_agen')); // Replaces all spaces with hyphens.
            $file_name = preg_replace('/[^A-Za-z0-9\-]/', '', $file_name) . "FileDokumen"; // Removes special chars.

            //INISIALISASI KONFIGURASI FILE UPLOAD
            $config['upload_path']          = './storage/uploads/dokumen_pendaftar/agen';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 4096;
            $config['file_name']            = $file_name;
            $config['overwrite']            = true;

            $this->load->library('upload');
            $this->upload->initialize($config);

            $id_agen = $this->input->post('id_agen');
            $nama_agen = $this->input->post('nama_agen');
            $email_agen = $this->input->post('email_agen');
            $telpon_agen = $this->input->post('telpon_agen');
            $alamat_agen = $this->input->post('alamat_agen');
            $lat_agen = $this->input->post('lat_agen');
            $lan_agen = $this->input->post('lan_agen');

            if (!$this->upload->do_upload('fileDokumen')) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                die;
                $this->session->set_flashdata('tambahBerhasil', 'false');
                redirect(site_url('ControllerMDT/indexAgenBaru'));
            }

            $editAgen = $this->modelMDTransaksiAgenBaru->updateAgen($id_agen, $nama_agen, $email_agen, $telpon_agen, $alamat_agen, $lat_agen, $lan_agen, $file_name);

            if ($editAgen == TRUE) {
                $this->session->set_flashdata('updateBerhasil', 'true');
                redirect(site_url('ControllerMDT/indexAgenBaru'));
            } else {
                $this->session->set_flashdata('updateBerhasil', 'false');
                redirect(site_url('ControllerMDT/indexAgenBaru'));
            }
        } else {
            $this->session->set_flashdata('updateBerhasil', 'false');
            redirect(site_url('ControllerMDT/indexAgenBaru'));
        }
    }

    public function getAgen()
    {
        if ($this->input->post('emailAgen')) {
            $dtilAgen = $this->modelMDTransaksiAgenBaru->getDataAgenAndroid($this->input->post('emailAgen'));
            echo json_encode($dtilAgen), JSON_FORCE_OBJECT;
        } else {
        }
    }
}
