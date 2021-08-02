<?php

class modelMDTransaksiAgenBaru extends CI_model
{
    var $table = "agen";
    var $order = array('id_agen', 'email_agen', 'no_telp_agen', 'alamat_lengkap_agen', 'tanggal_daftar_agen');

    // WEB INTERFACE
    private function _get_data_query()
    {
        $this->db->from($this->table);

        // SEARCH LOGIC
        $length = count($this->order);
        $filteredColumn = array();
        for ($i = 0; $i < $length; $i++) {
            if ($_POST["columns"]["$i"]["search"]["value"] != "") {
                array_push($filteredColumn, $i);
            }
        }

        if (count($filteredColumn) != 0) {
            $loopFiltered = count($filteredColumn);

            for ($i = 0; $i < $loopFiltered; $i++) {
                $temp = $this->order[$filteredColumn[$i]];
                $isiTemp = $_POST["columns"]["$filteredColumn[$i]"]["search"]["value"];
                $this->db->where($temp, $isiTemp);
            }

            if ($_POST['search']['value'] != "") {
                $searchColumn = array();
                for ($i = 0; $i < $length; $i++) {
                    if ($_POST["columns"]["$i"]["search"]["value"] == "") {
                        array_push($searchColumn, $i);
                    }
                }

                $tempSyntax = "(";
                for ($i = 0; $i < count($searchColumn); $i++) {
                    $tempColumn = $this->order[$searchColumn[$i]];
                    $searchValue = $_POST['search']['value'];
                    // TODO
                    if ($searchColumn[$i] == 0 && ctype_digit($searchValue)) {
                        $tempNumber = intval($searchValue);
                        $tempSyntax .= "$tempColumn = $tempNumber";
                        if ($i < count($searchColumn) - 1) {
                            $tempSyntax .= " OR ";
                        }
                    } else if ($searchColumn[$i] != 0) {
                        $tempSyntax .= "$tempColumn LIKE '%$searchValue%'";
                        if ($i < count($searchColumn) - 1) {
                            $tempSyntax .= " OR ";
                        }
                    }
                }
                $tempSyntax .= ")";
                $this->db->where($tempSyntax);
            }
        } else {
            $searchValue = $_POST['search']['value'];
            $this->db->like('id_agen', $searchValue);
            $this->db->or_like('nama_agen', $searchValue);
            $this->db->or_like('email_agen', $searchValue);
            $this->db->or_like('no_telp_agen', $searchValue);
            $this->db->or_like('alamat_lengkap_agen', $searchValue);
        }
        //END OF SEARCH LOGIC

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_agen', 'ASC');
        }
    }

    public function getDataTable()
    {
        $this->_get_data_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_data()
    {
        $this->_get_data_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getDataAgen($id_agen)
    {
        $this->db->from('agen');
        $this->db->where("ID_AGEN", $id_agen);
        return $this->db->get()->first_row();
    }

    public function tambahDataAgen($nama_agen, $email_agen, $telpon_agen, $alamat_agen, $lat_agen, $lan_agen, $file_name)
    {
        $getMaxID = $this->db->query("SELECT MAX(CAST(SUBSTRING(ID_AGEN, 5, length(ID_AGEN)-4) AS UNSIGNED))+1 AS ID FROM agen")->result_array();

        $data = array(
            'ID_AGEN' => "AGEN" . $getMaxID['0']['ID'],
            'ID_JENIS_USER' => "U3",
            'NAMA_AGEN' => $nama_agen,
            'EMAIL_AGEN' => $email_agen,
            'NO_TELP_AGEN' => $telpon_agen,
            'ALAMAT_LENGKAP_AGEN' => $alamat_agen,
            'LONGTITUDE' => $lat_agen,
            'LATITUDE' => $lan_agen,
            'TANGGAL_DAFTAR_AGEN' => date('Y-m-d h:i:sa'),
            'DOKUMEN_DAFTAR_AGEN' => $file_name
        );

        $this->db->insert($this->table, $data);
        return true;
    }

    public function updateAgen($id_agen, $nama_agen, $email_agen, $telpon_agen, $alamat_agen, $lat_agen, $lan_agen, $file_name)
    {
        $this->db->set('NAMA_AGEN', $nama_agen);
        $this->db->set('EMAIL_AGEN', $email_agen);
        $this->db->set('NO_TELP_AGEN', $telpon_agen);
        $this->db->set('ALAMAT_LENGKAP_AGEN', $alamat_agen);
        $this->db->set('LONGTITUDE', $lat_agen);
        $this->db->set('LATITUDE', $lan_agen);
        $this->db->where('ID_AGEN', $id_agen);
        $this->db->update($this->table); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
        return true;
    }
    // END OF WEB INTERFACE

    // ANDROID INTERFACE
    public function getDataAgenAndroid($email)
    {
        $this->db->from('agen');
        $this->db->where("EMAIL_AGEN", $email);
        $hasil = $this->db->get()->num_rows();
        if ($hasil != 0) {
            return $this->db->from('agen')->where("EMAIL_AGEN", $email)->get()->first_row();
        } else {
            return array("MESSAGE" => 0);
        }
    }
}
