<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControllerAndroid extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelMDTransaksiAgenBaru');
        $this->load->model('ModelTransaksiAndroid');
    }

    public function getAgen()
    {
        if ($this->input->post('emailAgen')) {
            $dtilAgen = $this->modelMDTransaksiAgenBaru->getDataAgenAndroid($this->input->post('emailAgen'));
            echo json_encode($dtilAgen);
        } else {
            echo json_encode(array("MESSAGE" => "ERROR INTERNAL SERVER"));
        }
    }

    public function daftarMember()
    {
        if ($this->input->post('idMember')) {
            $id_member = $this->input->post('idMember');
            $id_JU = $this->input->post('idJenisUser');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $jenkel = $this->input->post('jenkel');
            $telp = $this->input->post('telp');

            $this->ModelTransaksiAndroid->tambahMember($id_member, $id_JU, $nama, $email, $jenkel, $telp);
        } else {
        }
    }


    public function checkUser()
    {
        if ($this->input->post('email')) {
            $email = $this->input->post('email');

            $hasil = $this->ModelTransaksiAndroid->cekUser($email);
            echo json_encode(array("MESSAGE" => $hasil), JSON_FORCE_OBJECT);
        } else {
        }
    }

    public function updateAgenUserID()
    {
        if ($this->input->post('emailAgen')) {
            $email = $this->input->post('emailAgen');
            $UID = $this->input->post('userID');

            $this->ModelTransaksiAndroid->updateAgenUID($email, $UID);
        } else {
        }
    }

    public function tambahBarangLoak()
    {
        if ($this->input->post('id_transaksi')) {
            $id_transaksi = $this->input->post('id_transaksi');
            $id_member = $this->input->post('id_member');
            $lat_barang = $this->input->post('lat_barang');
            $long_barang = $this->input->post('long_barang');
            $nama_barang = $this->input->post('nama_barang');
            $berat_barang = $this->input->post('berat_barang');
            $jenis_barang = $this->input->post('jenis_barang');
            $keterangan_barang = $this->input->post('keterangan_barang');
            $alamat_barang = $this->input->post('alamat_barang');

            //INISIALISASI KONFIGURASI FILE UPLOAD
            $config['upload_path']          = './storage/uploads/LoakIn/FotoBarang';
            $config['allowed_types']        = 'jpg|jpeg|png|';
            $config['max_size']             = 4096;
            $config['file_name']            = $id_transaksi;
            $config['overwrite']            = true;

            $this->load->library('upload');
            $this->upload->initialize($config);

            $path = $_FILES['gambar_barang']['name'];
            $ext = "." . pathinfo($path, PATHINFO_EXTENSION);
            $nama_gambar = $id_transaksi . $ext;

            if ($this->upload->do_upload('gambar_barang')) {
                $this->ModelTransaksiAndroid->tambahBarangLoak($id_transaksi, $lat_barang, $long_barang, $nama_barang, $jenis_barang, $berat_barang, $keterangan_barang, $alamat_barang, $id_member, $nama_gambar);
            }
        }
    }

    public function bacaProsesTransaksiMember()
    {
        if ($this->input->post('id_member')) {
            $id_member = $this->input->post('id_member');
            $this->ModelTransaksiAndroid->bacaProsesTransaksiMember($id_member);
        }
    }

    public function bacaSelesaiTransaksiMember()
    {
        if ($this->input->post('id_member')) {
            $id_member = $this->input->post('id_member');
            $this->ModelTransaksiAndroid->bacaSelesaiTransaksiMember($id_member);
        }
    }

    public function getDataAgen()
    {
        $this->ModelTransaksiAndroid->getDataAgen();
    }

    public function getTransaksiJual()
    {
        $this->ModelTransaksiAndroid->getTransaksiJual();
    }

    public function getDetailTransaksi()
    {
        if ($this->input->post('id_transaksi')) {
            $id_transaksi = $this->input->post('id_transaksi');
            $this->ModelTransaksiAndroid->getDetailTransaksi($id_transaksi);
        }
    }

    public function updateTransaksi()
    {
        if ($this->input->post('id_transaksi')) {
            $id_transaksi = $this->input->post('id_transaksi');
            $id_agen = $this->input->post('id_agen');
            $status_transaksi = $this->input->post('status_transaksi');

            $this->ModelTransaksiAndroid->updateTransaksi($id_transaksi, $id_agen, $status_transaksi);
        }
    }

    public function cancelTransaksi()
    {
        if ($this->input->post('id_transaksi')) {
            $id_transaksi = $this->input->post('id_transaksi');
            $status_transaksi = $this->input->post('status_transaksi');
            $this->ModelTransaksiAndroid->cancelTransaksi($id_transaksi, $status_transaksi);
        }
    }

    public function readTransaksiAgen()
    {
        if ($this->input->post('uid_agen')) {
            $uid_agen = $this->input->post('uid_agen');
            $this->ModelTransaksiAndroid->readTransaksiAgen($uid_agen);
        }
    }

    public function readTransaksiSelesaiAgen()
    {
        if ($this->input->post('uid_agen')) {
            $uid_agen = $this->input->post('uid_agen');
            $this->ModelTransaksiAndroid->readTransaksiSelesaiAgen($uid_agen);
        }
    }

    public function getProfilMember()
    {
        if ($this->input->post('id_member')) {
            $id_member = $this->input->post('id_member');
            $this->ModelTransaksiAndroid->getProfilMember($id_member);
        }
    }

    public function getProfilAgen()
    {
        if ($this->input->post('uid_agen')) {
            $uid_agen = $this->input->post('uid_agen');
            $this->ModelTransaksiAndroid->getProfilAgen($uid_agen);
        }
    }

    public function getChartData()
    {
        if ($this->input->post('JU')) {
            $ju = $this->input->post('JU');
            $id = $this->input->post('ID');
            $this->ModelTransaksiAndroid->getChartData($ju, $id);
        }
    }
}
