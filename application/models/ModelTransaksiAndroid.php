<?php

class ModelTransaksiAndroid extends CI_model
{
    public function tambahMember($id_member, $id_JU, $nama, $email, $jenkel, $telp)
    {
        $data = array(
            'ID_MEMBER' => $id_member,
            'ID_JENIS_USER' => $id_JU,
            'NAMA_LENGKAP_MEMBER' => $nama,
            'EMAIL_MEMBER' => $email,
            'JENIS_KELAMIN_MEMBER' => $jenkel,
            'NO_TELP_MEMBER' => $telp,
            'TANGGAL_DAFTAR_MEMBER' => date('Y-m-d h:i:sa'),
        );
        $this->db->insert('member', $data);
    }

    public function cekUser($email)
    {
        $hasil = 0;
        $this->db->from("Agen");
        $this->db->where("EMAIL_AGEN", $email);
        $cek = $this->db->get()->num_rows();
        if ($cek == 0) {
            $this->db->from("Member");
            $this->db->where("EMAIL_MEMBER", $email);
            $cek = $this->db->get()->num_rows();
            if ($cek > 0) {
                $hasil = 1;
            }
        } else if ($cek > 0) {
            $hasil = 1;
        }
        return $hasil;
    }

    public function updateAgenUID($email, $UID)
    {
        $this->db->set('AGEN_USER_ID', $UID);
        $this->db->where('EMAIL_AGEN', $email);
        $this->db->update('Agen');
    }

    public function tambahBarangLoak($id_transaksi, $lat_barang, $long_barang, $nama_barang, $jenis_barang, $berat_barang, $keterangan_barang, $alamat_barang, $id_member, $nama_gambar)
    {
        $data = array(
            'ID_TRANSAKSI' => $id_transaksi,
            'ID_JENIS_TRANSAKSI' => "JT1",
            'ID_STATUS_TRANSAKSI' => "ST1",
            'ID_MEMBER' => $id_member,
            'NAMA_BARANG_LOAK' => $nama_barang,
            'JENIS_BARANG' => $jenis_barang,
            'BERAT_BARANG' => $berat_barang,
            'TANGGAL_TRANSAKSI' => date('Y-m-d h:i:sa'),
            'KETERANGAN_TRANSAKSI' => $keterangan_barang,
            'ALAMAT_TRANSAKSI' => $alamat_barang,
            'LAT_MEMBER' => $lat_barang,
            'LONG_MEMBER' => $long_barang,
            'FOTO_BARANG' => $nama_gambar
        );
        $this->db->insert('Transaksi', $data);
    }

    public function bacaProsesTransaksiMember($id_member)
    {
        $ST = array('ST1', 'ST2');
        $this->db->from('Transaksi');
        $this->db->join('Status_Transaksi', 'Status_Transaksi.ID_STATUS_TRANSAKSI = Transaksi.ID_STATUS_TRANSAKSI');
        $this->db->where_in('Transaksi.ID_STATUS_TRANSAKSI', $ST);
        $this->db->where('ID_MEMBER', $id_member);
        echo json_encode($this->db->get()->result_object());
    }

    public function bacaSelesaiTransaksiMember($id_member)
    {
        $ST = array('ST3', 'ST4');
        $this->db->from('Transaksi');
        $this->db->join('Status_Transaksi', 'Status_Transaksi.ID_STATUS_TRANSAKSI = Transaksi.ID_STATUS_TRANSAKSI');
        $this->db->where_in('Transaksi.ID_STATUS_TRANSAKSI', $ST);
        $this->db->where('ID_MEMBER', $id_member);
        echo json_encode($this->db->get()->result_object());
    }

    public function getDataAgen()
    {
        echo json_encode($this->db->from('agen')->get()->result_object());
    }

    public function getTransaksiJual()
    {
        echo json_encode($this->db->from('transaksi')->where("ID_STATUS_TRANSAKSI =", "ST1")->get()->result_object());
    }

    public function getDetailTransaksi($id_transaksi)
    {
        echo json_encode($this->db->from('transaksi')->where("transaksi.ID_TRANSAKSI =", "$id_transaksi")->join('Member', 'member.ID_MEMBER = transaksi.ID_MEMBER')->get()->first_row(), JSON_FORCE_OBJECT);
    }

    public function updateTransaksi($id_transaksi, $id_agen, $status_transaksi)
    {

        $this->db->set('ID_AGEN', $id_agen);
        $this->db->set('ID_STATUS_TRANSAKSI', $status_transaksi);
        $this->db->where('ID_TRANSAKSI', $id_transaksi);
        $this->db->update('Transaksi');
    }

    public function cancelTransaksi($id_transaksi, $status_transaksi)
    {
        $this->db->set('ID_STATUS_TRANSAKSI', $status_transaksi);
        $this->db->set('ID_AGEN', NULL);
        $this->db->where('ID_TRANSAKSI', $id_transaksi);
        $this->db->update('Transaksi');
    }

    public function readTransaksiAgen($uid_agen)
    {
        $dataAgen = $this->db->from('Agen')->where('AGEN_USER_ID', $uid_agen)->get()->row_array();
        if ($dataAgen != null) {
            $ST = array('ST2');
            $this->db->from('Transaksi');
            $this->db->join('Status_Transaksi', 'Status_Transaksi.ID_STATUS_TRANSAKSI = Transaksi.ID_STATUS_TRANSAKSI');
            $this->db->join('Member', 'Member.ID_MEMBER = Transaksi.ID_MEMBER');
            $this->db->where_in('Transaksi.ID_STATUS_TRANSAKSI', $ST);
            $this->db->where('ID_AGEN', $dataAgen["ID_AGEN"]);
            echo json_encode($this->db->get()->result_object());
        }
    }

    public function readTransaksiSelesaiAgen($uid_agen)
    {
        $dataAgen = $this->db->from('Agen')->where('AGEN_USER_ID', $uid_agen)->get()->row_array();
        if ($dataAgen != null) {
            $ST = array('ST4');
            $this->db->from('Transaksi');
            $this->db->join('Status_Transaksi', 'Status_Transaksi.ID_STATUS_TRANSAKSI = Transaksi.ID_STATUS_TRANSAKSI');
            $this->db->join('Member', 'Member.ID_MEMBER = Transaksi.ID_MEMBER');
            $this->db->where_in('Transaksi.ID_STATUS_TRANSAKSI', $ST);
            $this->db->where('ID_AGEN', $dataAgen["ID_AGEN"]);
            echo json_encode($this->db->get()->result_object());
        }
    }

    public function getProfilMember($id_member)
    {
        $dataMember = $this->db->from('Member')->where('ID_MEMBER', $id_member)->get()->row_array();
        $totalOrder = $this->db->from('Transaksi')->where('ID_MEMBER', $id_member)->count_all_results();
        $orderBerhasil = $this->db->from('Transaksi')->where('ID_MEMBER', $id_member)->where('ID_STATUS_TRANSAKSI', 'ST4')->count_all_results();
        echo json_encode(array('NAMA' => $dataMember['NAMA_LENGKAP_MEMBER'], 'EMAIL' => $dataMember['EMAIL_MEMBER'], 'TELP' => $dataMember['NO_TELP_MEMBER'], 'JK' => $dataMember['JENIS_KELAMIN_MEMBER'], 'TGL_DAFTAR' => $dataMember['TANGGAL_DAFTAR_MEMBER'], 'TOTAL_ORDER' => $totalOrder, 'ORDER_BERHASIL' => $orderBerhasil), JSON_FORCE_OBJECT);
    }

    public function getProfilAgen($uid_agen)
    {
        $dataAgen = $this->db->from('Agen')->where('AGEN_USER_ID', $uid_agen)->get()->row_array();
        if ($dataAgen != null) {
            $totalOrder = $this->db->from('Transaksi')->where('ID_AGEN', $dataAgen['ID_AGEN'])->where('ID_STATUS_TRANSAKSI', 'ST4')->count_all_results();
            echo json_encode(array('NAMA' => $dataAgen['NAMA_AGEN'], 'EMAIL' => $dataAgen['EMAIL_AGEN'], 'TELP' => $dataAgen['NO_TELP_AGEN'], 'ALAMAT' => $dataAgen['ALAMAT_LENGKAP_AGEN'], 'TANGGAL_DAFTAR' => $dataAgen['TANGGAL_DAFTAR_AGEN'], 'TOTAL_ORDER' => $totalOrder), JSON_FORCE_OBJECT);
        }
    }

    public function getChartData($ju, $id)
    {
        if ($ju == "U2") {
            $output = $this->db->query("SELECT 
            c.ID_MEMBER				AS `ID_MEMBER`
            , d.day					AS `HARI`
            , COUNT(t.ID_TRANSAKSI)	AS `TOTAL_TRANSAKSI`
       FROM ( SELECT '$id' AS ID_MEMBER ) c
       CROSS JOIN ( SELECT 1 AS `dow`, 'Sunday' AS `day`
                UNION ALL SELECT 2, 'Monday'
                UNION ALL SELECT 3, 'Tuesday'
                UNION ALL SELECT 4, 'Wednesday'
                UNION ALL SELECT 5, 'Thursday'
                UNION ALL SELECT 6, 'Friday'
                UNION ALL SELECT 7, 'Saturday'
              ) d
         LEFT
         JOIN transaksi t
           ON t.ID_MEMBER = c.ID_MEMBER
          AND t.TANGGAL_TRANSAKSI >= DATE(NOW()) + INTERVAL -7 DAY
          AND t.TANGGAL_TRANSAKSI <  DATE(NOW())
          AND DAYOFWEEK(t.TANGGAL_TRANSAKSI) = d.dow
          AND t.ID_STATUS_TRANSAKSI = 'ST4'
        GROUP BY c.ID_MEMBER, d.dow
        ORDER BY c.ID_MEMBER, d.dow
       ")->result_array();

            echo json_encode($output);
        } elseif ($ju == "U3") {
            $output = $this->db->query("SELECT 
                c.ID_AGEN AS `ID_AGEN` , 
                d.day AS `HARI` , 
                COUNT(t.ID_TRANSAKSI) AS `TOTAL_TRANSAKSI` 
                FROM ( SELECT '$id' AS ID_AGEN ) c 
                CROSS JOIN 
                ( SELECT 1 AS `dow`, 'Sunday' AS `day` UNION ALL SELECT 2, 
                'Monday' UNION ALL SELECT 3, 
                'Tuesday' UNION ALL SELECT 4, 
                'Wednesday' UNION ALL SELECT 5, 
                'Thursday' UNION ALL SELECT 6, 'Friday' 
                UNION ALL SELECT 7, 'Saturday' ) d 
                LEFT JOIN transaksi t 
                ON t.ID_AGEN = c.ID_AGEN AND t.TANGGAL_TRANSAKSI >= 
                DATE(NOW()) + INTERVAL -7 DAY AND t.TANGGAL_TRANSAKSI < 
                DATE(NOW()) AND DAYOFWEEK(t.TANGGAL_TRANSAKSI) = d.dow 
                AND t.ID_STATUS_TRANSAKSI = 'ST4' 
                GROUP BY c.ID_AGEN, d.dow 
                ORDER BY c.ID_AGEN, d.dow ")->result_array();

            echo json_encode($output);
        }
    }
}
