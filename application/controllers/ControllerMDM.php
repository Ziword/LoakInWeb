<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControllerMDM extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelMDMBarangLoak');
        $this->load->model('ModelMDMJenisBarangLoak');
        $this->load->model('ModelMDMStatusTransaksi');
        $this->load->model('ModelMDMJenisTransaksi');
        $this->load->model('ModelMDMJenisUser');

        if (is_null($_SESSION['id_admin'])) {
            $this->session->set_flashdata('perluLogin', 'true');
            redirect(site_url('Clogin'));
        }
    }

    // MDM BARANG
    // MDM BARANG LOAK
    public function mdmBarangLoak()
    {
        $data['judul'] = "MDM Barang Loak";
        $data['jenis_barang_loak'] = $this->ModelMDMBarangLoak->getJenisBarangLoak();
        $this->load->view('templates/header', $data);
        $this->load->view('mdm/barang_loak/v_barang_loak', $data);
        $this->load->view('templates/footer');
    }

    public function getDataBarangLoak()
    {
        if ($this->input->post()) {
            $results = $this->ModelMDMBarangLoak->getDataTable();
            $data = [];
            foreach ($results as $result) {
                $row = array();
                $row[] = $result->ID_BARANG_LOAK;
                $row[] = $result->NAMA_JENIS_BARANG_LOAK;
                $row[] = $result->NAMA_BARANG_LOAK;
                $row[] = $result->HARGA_PERKG_BARANG_LOAK;
                $row[] = ($result->STATUS_BARANG_LOAK > 0 ? "Aktif" : "Tidak Aktif");
                $row[] = "<button type='button' class='btn btn-success btn-sm' value='$result->ID_BARANG_LOAK' onclick='editData(this.value)'>Edit</button>";
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST["draw"],
                "recordsTotal" => $this->ModelMDMBarangLoak->count_all_data(),
                "recordsFiltered" => $this->ModelMDMBarangLoak->count_filtered_data(),
                "data" => $data,
            );
            $this->output->set_content_type("application/json")->set_output(json_encode($output));
        }
    }

    public function fetchBarangLoak()
    {
        if ($this->input->post('id_BL')) {
            $detilBL = $this->ModelMDMBarangLoak->getDataBL($this->input->post('id_BL'));
            echo json_encode($detilBL);
        } else {
            redirect(site_url('ControllerMDM/mdmBarangLoak'));
        }
    }

    public function tambahBarangLoak()
    {
        if ($this->input->post('jbl')) {
            $id_jbl = $this->input->post('jbl');
            $nama_bl = $this->input->post('nama_bl');
            $harga_bl = $this->input->post('harga_bl');
            $status_bl = $this->input->post('status');

            $barangLoak = $this->ModelMDMBarangLoak->tambahDataBarangLoak($id_jbl, $nama_bl, $harga_bl, $status_bl);

            if ($barangLoak == TRUE) {
                $this->session->set_flashdata('tambahBerhasil', 'true');
                redirect(site_url('ControllerMDM/mdmBarangLoak'));
            } else {
                $this->session->set_flashdata('tambahBerhasil', 'false');
                redirect(site_url('ControllerMDM/mdmBarangLoak'));
            }
        } else {
            redirect(site_url('ControllerMDM/mdmBarangLoak'));
        }
    }

    public function editBarangLoak()
    {
        if ($this->input->post('jbl')) {
            $id_Bl = $this->input->post('id_barang_loak');
            $id_jbl = $this->input->post('jbl');
            $nama_bl = $this->input->post('nama_bl');
            $harga_bl = $this->input->post('harga_bl');
            $status_bl = $this->input->post('status');

            $editBarangLoak = $this->ModelMDMBarangLoak->updateDataBarangLoak($id_Bl, $id_jbl, $nama_bl, $harga_bl, $status_bl);

            if ($editBarangLoak == TRUE) {
                $this->session->set_flashdata('updateBerhasil', 'true');
                redirect(site_url('ControllerMDM/mdmBarangLoak'));
            } else {
                $this->session->set_flashdata('updateBerhasil', 'false');
                redirect(site_url('ControllerMDM/mdmBarangLoak'));
            }
        } else {
            redirect(site_url('ControllerMDM/mdmBarangLoak'));
        }
    }
    // Akhir MDM BARANG LOAK

    // MDM JENIS BARANG LOAK
    public function mdmJenisBarangLoak()
    {
        $data['judul'] = "MDM Barang Loak";
        $this->load->view('templates/header', $data);
        $this->load->view('mdm/jenis_barang_loak/v_jenis_barang_loak', $data);
        $this->load->view('templates/footer');
    }

    public function getDataJenisBarangLoak()
    {
        if ($this->input->post()) {
            $results = $this->ModelMDMJenisBarangLoak->getDataTable();
            $data = [];
            foreach ($results as $result) {
                $row = array();
                $row[] = $result->ID_JENIS_BARANG_LOAK;
                $row[] = $result->NAMA_JENIS_BARANG_LOAK;
                $row[] = ($result->JBL_STATUS > 0 ? "Aktif" : "Tidak Aktif");
                $row[] = "<button type='button' class='btn btn-success btn-sm' value='$result->ID_JENIS_BARANG_LOAK' onclick='editData(this.value)'>Edit</button>";
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST["draw"],
                "recordsTotal" => $this->ModelMDMJenisBarangLoak->count_all_data(),
                "recordsFiltered" => $this->ModelMDMJenisBarangLoak->count_filtered_data(),
                "data" => $data,
            );
            $this->output->set_content_type("application/json")->set_output(json_encode($output));
        }
    }

    public function fetchJenisBarangLoak()
    {
        if ($this->input->post('id_jbl')) {
            $detilJBL = $this->ModelMDMJenisBarangLoak->getDataJBL($this->input->post('id_jbl'));
            echo json_encode($detilJBL);
        } else {
            redirect(site_url('ControllerMDM/mdmJenisBarangLoak'));
        }
    }

    public function tambahJenisBarangLoak()
    {
        if ($this->input->post('nama_jbl')) {
            $nama_jbl = $this->input->post('nama_jbl');
            $status_jbl = $this->input->post('status');

            $jenisBarangLoak = $this->ModelMDMJenisBarangLoak->tambahDataJenisBarangLoak($nama_jbl, $status_jbl);

            if ($jenisBarangLoak == TRUE) {
                $this->session->set_flashdata('tambahBerhasil', 'true');
                redirect(site_url('ControllerMDM/mdmJenisBarangLoak'));
            } else {
                $this->session->set_flashdata('tambahBerhasil', 'false');
                redirect(site_url('ControllerMDM/mdmJenisBarangLoak'));
            }
        } else {
            redirect(site_url('ControllerMDM/mdmJenisBarangLoak'));
        }
    }

    public function editJenisBarangLoak()
    {
        if ($this->input->post('id_jbl')) {
            $id_jbl = $this->input->post('id_jbl');
            $nama_jbl = $this->input->post('nama_jbl');
            $status_jbl = $this->input->post('status');

            $editJenisBarangLoak = $this->ModelMDMJenisBarangLoak->updateDataJenisBarangLoak($id_jbl, $nama_jbl, $status_jbl);

            if ($editJenisBarangLoak == TRUE) {
                $this->session->set_flashdata('updateBerhasil', 'true');
                redirect(site_url('ControllerMDM/mdmJenisBarangLoak'));
            } else {
                $this->session->set_flashdata('updateBerhasil', 'false');
                redirect(site_url('ControllerMDM/mdmJenisBarangLoak'));
            }
        } else {
            redirect(site_url('ControllerMDM/mdmJenisBarangLoak'));
        }
    }
    // AKHIR MDM JENIS BARANG LOAK
    // END OF MDM BARANG

    // MDM TRANSAKSI
    // MDM STATUS TRANSAKSI
    public function mdmStatusTransaksi()
    {
        $data['judul'] = "MDM Transaksi";
        $this->load->view('templates/header', $data);
        $this->load->view('mdm/status_transaksi/v_status_transaksi', $data);
        $this->load->view('templates/footer');
    }

    public function getDataStatusTransaksi()
    {
        if ($this->input->post()) {
            $results = $this->ModelMDMStatusTransaksi->getDataTable();
            $data = [];
            foreach ($results as $result) {
                $row = array();
                $row[] = $result->ID_STATUS_TRANSAKSI;
                $row[] = $result->NAMA_STATUS_TRANSAKSI;
                $row[] = ($result->ST_STATUS > 0 ? "Aktif" : "Tidak Aktif");
                $row[] = "<button type='button' class='btn btn-success btn-sm' value='$result->ID_STATUS_TRANSAKSI' onclick='editData(this.value)'>Edit</button>";
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST["draw"],
                "recordsTotal" => $this->ModelMDMStatusTransaksi->count_all_data(),
                "recordsFiltered" => $this->ModelMDMStatusTransaksi->count_filtered_data(),
                "data" => $data,
            );
            $this->output->set_content_type("application/json")->set_output(json_encode($output));
        }
    }

    public function fetchStatusTransaksi()
    {
        if ($this->input->post('id_st')) {
            $detilBL = $this->ModelMDMStatusTransaksi->getDataST($this->input->post('id_st'));
            echo json_encode($detilBL);
        } else {
            redirect(site_url('ControllerMDM/mdmStatusTransaksi'));
        }
    }

    public function tambahStatusTransaksi()
    {
        if ($this->input->post('nama_st')) {
            $nama_st = $this->input->post('nama_st');
            $status_st = $this->input->post('status');

            $statusTransaksi = $this->ModelMDMStatusTransaksi->tambahDataStatusTransaksi($nama_st, $status_st);

            if ($statusTransaksi == TRUE) {
                $this->session->set_flashdata('tambahBerhasil', 'true');
                redirect(site_url('ControllerMDM/mdmStatusTransaksi'));
            } else {
                $this->session->set_flashdata('tambahBerhasil', 'false');
                redirect(site_url('ControllerMDM/mdmStatusTransaksi'));
            }
        } else {
            redirect(site_url('ControllerMDM/mdmStatusTransaksi'));
        }
    }

    public function editStatusTransaksi()
    {
        if ($this->input->post('id_st')) {
            $id_st = $this->input->post('id_st');
            $nama_st = $this->input->post('nama_st');
            $status_st = $this->input->post('status');

            $editStatusTransaksi = $this->ModelMDMStatusTransaksi->updateStatusTransaksi($id_st, $nama_st, $status_st);

            if ($editStatusTransaksi == TRUE) {
                $this->session->set_flashdata('updateBerhasil', 'true');
                redirect(site_url('ControllerMDM/mdmStatusTransaksi'));
            } else {
                $this->session->set_flashdata('updateBerhasil', 'false');
                redirect(site_url('ControllerMDM/mdmStatusTransaksi'));
            }
        } else {
            redirect(site_url('ControllerMDM/mdmStatusTransaksi'));
        }
    }
    // END MDM STATUS TRANSAKSI

    // MDM JENIS TRANSAKSI
    public function mdmJenisTransaksi()
    {
        $data['judul'] = "MDM Transaksi";
        $this->load->view('templates/header', $data);
        $this->load->view('mdm/jenis_transaksi/v_jenis_transaksi', $data);
        $this->load->view('templates/footer');
    }

    public function getDataJenisTransaksi()
    {
        if ($this->input->post()) {
            $results = $this->ModelMDMJenisTransaksi->getDataTable();
            $data = [];
            foreach ($results as $result) {
                $row = array();
                $row[] = $result->ID_JENIS_TRANSAKSI;
                $row[] = $result->NAMA_JENIS_TRANSAKSI;
                $row[] = ($result->JT_STATUS > 0 ? "Aktif" : "Tidak Aktif");
                $row[] = "<button type='button' class='btn btn-success btn-sm' value='$result->ID_JENIS_TRANSAKSI' onclick='editData(this.value)'>Edit</button>";
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST["draw"],
                "recordsTotal" => $this->ModelMDMJenisTransaksi->count_all_data(),
                "recordsFiltered" => $this->ModelMDMJenisTransaksi->count_filtered_data(),
                "data" => $data,
            );
            $this->output->set_content_type("application/json")->set_output(json_encode($output));
        }
    }

    public function fetchJenisTransaksi()
    {
        if ($this->input->post('id_jt')) {
            $hasil = $this->ModelMDMJenisTransaksi->getDataJT($this->input->post('id_jt'));
            echo json_encode($hasil);
        } else {
            redirect(site_url('ControllerMDM/mdmJenisTransaksi'));
        }
    }

    public function tambahJenisTransaksi()
    {
        if ($this->input->post('nama_jt')) {
            $nama_jt = $this->input->post('nama_jt');
            $status_jt = $this->input->post('status');

            $hasil = $this->ModelMDMJenisTransaksi->tambahDataStatusTransaksi($nama_jt, $status_jt);

            if ($hasil == TRUE) {
                $this->session->set_flashdata('tambahBerhasil', 'true');
                redirect(site_url('ControllerMDM/mdmJenisTransaksi'));
            } else {
                $this->session->set_flashdata('tambahBerhasil', 'false');
                redirect(site_url('ControllerMDM/mdmJenisTransaksi'));
            }
        } else {
            redirect(site_url('ControllerMDM/mdmJenisTransaksi'));
        }
    }

    public function editJenisTransaksi()
    {
        if ($this->input->post('id_jt')) {
            $id_jt = $this->input->post('id_jt');
            $nama_jt = $this->input->post('nama_jt');
            $status_jt = $this->input->post('status');

            $hasil = $this->ModelMDMJenisTransaksi->updateJenisTransaksi($id_jt, $nama_jt, $status_jt);

            if ($hasil == TRUE) {
                $this->session->set_flashdata('updateBerhasil', 'true');
                redirect(site_url('ControllerMDM/mdmJenisTransaksi'));
            } else {
                $this->session->set_flashdata('updateBerhasil', 'false');
                redirect(site_url('ControllerMDM/mdmJenisTransaksi'));
            }
        } else {
            redirect(site_url('ControllerMDM/mdmJenisTransaksi'));
        }
    }
    // END MDM JENIS TRANSAKSI
    // END OF MDM TRANSAKSI

    // MDM USER
    // MDM JENIS USER
    public function mdmJenisUser()
    {
        $data['judul'] = "MDM User";
        $this->load->view('templates/header', $data);
        $this->load->view('mdm/jenis_user/v_jenis_user', $data);
        $this->load->view('templates/footer');
    }

    public function getDataJenisUser()
    {
        if ($this->input->post()) {
            $results = $this->ModelMDMJenisUser->getDataTable();
            $data = [];
            foreach ($results as $result) {
                $row = array();
                $row[] = $result->ID_JENIS_USER;
                $row[] = $result->NAMA_JENIS_USER;
                $row[] = ($result->JU_STATUS > 0 ? "Aktif" : "Tidak Aktif");
                $row[] = "<button type='button' class='btn btn-success btn-sm' value='$result->ID_JENIS_USER' onclick='editData(this.value)'>Edit</button>";
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST["draw"],
                "recordsTotal" => $this->ModelMDMJenisUser->count_all_data(),
                "recordsFiltered" => $this->ModelMDMJenisUser->count_filtered_data(),
                "data" => $data,
            );
            $this->output->set_content_type("application/json")->set_output(json_encode($output));
        }
    }

    public function fetchJenisUser()
    {
        if ($this->input->post('id_ju')) {
            $hasil = $this->ModelMDMJenisUser->getDataJU($this->input->post('id_ju'));
            echo json_encode($hasil);
        } else {
            redirect(site_url('ControllerMDM/mdmJenisUser'));
        }
    }

    public function tambahJenisUser()
    {
        if ($this->input->post('nama_ju')) {
            $nama_ju = $this->input->post('nama_ju');
            $status_ju = $this->input->post('status');

            $hasil = $this->ModelMDMJenisUser->tambahDataJenisUser($nama_ju, $status_ju);

            if ($hasil == TRUE) {
                $this->session->set_flashdata('tambahBerhasil', 'true');
                redirect(site_url('ControllerMDM/mdmJenisUser'));
            } else {
                $this->session->set_flashdata('tambahBerhasil', 'false');
                redirect(site_url('ControllerMDM/mdmJenisUser'));
            }
        } else {
            redirect(site_url('ControllerMDM/mdmJenisUser'));
        }
    }

    public function editJenisUser()
    {
        if ($this->input->post('id_ju')) {
            $id_ju = $this->input->post('id_ju');
            $nama_ju = $this->input->post('nama_ju');
            $status_ju = $this->input->post('status');

            $hasil = $this->ModelMDMJenisUser->updateJenisUser($id_ju, $nama_ju, $status_ju);

            if ($hasil == TRUE) {
                $this->session->set_flashdata('updateBerhasil', 'true');
                redirect(site_url('ControllerMDM/mdmJenisUser'));
            } else {
                $this->session->set_flashdata('updateBerhasil', 'false');
                redirect(site_url('ControllerMDM/mdmJenisUser'));
            }
        } else {
            redirect(site_url('ControllerMDM/mdmJenisUser'));
        }
    }
    // MDM JENIS USER
    // END OF MDM USER
}
