<?php

class ModelMDMBarangLoak extends CI_model
{
    var $table = "barang_loak";
    var $order = array('id_barang_loak', 'nama_jenis_barang_loak', 'nama_barang_loak', 'harga_perkg_barang_loak', 'status_barang_loak');

    private function _get_data_query()
    {
        $this->db->distinct();
        $this->db->from('barang_loak');
        $this->db->join('jenis_barang_loak', 'barang_loak.id_jenis_barang_loak = jenis_barang_loak.id_jenis_barang_loak');

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
            $this->db->like('id_barang_loak', $searchValue);
            $this->db->or_like('barang_loak.id_jenis_barang_loak', $searchValue);
            $this->db->or_like('nama_barang_loak', $searchValue);
            $this->db->or_like('harga_perkg_barang_loak', $searchValue);
        }

        //END OF SEARCH LOGIC

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_barang_loak', 'ASC');
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

    public function getJenisBarangLoak()
    {
        $this->db->from('jenis_barang_loak');
        $this->db->where('JBL_Status', 0);
        return $this->db->get()->result_array();
    }

    public function tambahDataBarangLoak($id_jbl, $nama_bl, $harga_bl, $status_bl)
    {
        $getMaxID = $this->db->query("SELECT MAX(CAST(SUBSTRING(ID_BARANG_LOAK, 3, length(ID_BARANG_LOAK)-2) AS UNSIGNED))+1 AS ID FROM barang_loak")->result_array();

        $data = array(
            'ID_BARANG_LOAK' => "BL" . $getMaxID['0']['ID'],
            'ID_JENIS_BARANG_LOAK' => $id_jbl,
            'NAMA_BARANG_LOAK' => $nama_bl,
            'HARGA_PERKG_BARANG_LOAK' => $harga_bl,
            'STATUS_BARANG_LOAK' => $status_bl,
        );

        $this->db->insert($this->table, $data);
        return true;
    }

    public function getDataBL($id_BL)
    {
        $this->db->from('barang_loak');
        $this->db->join('jenis_barang_loak', 'barang_loak.id_jenis_barang_loak = jenis_barang_loak.id_jenis_barang_loak');
        $this->db->where("ID_BARANG_LOAK", $id_BL);
        return $this->db->get()->first_row();
    }

    public function updateDataBarangLoak($id_BL, $id_jbl, $nama_bl, $harga_bl, $status_bl)
    {
        $this->db->set('ID_JENIS_BARANG_LOAK', $id_jbl);
        $this->db->set('NAMA_BARANG_LOAK', $nama_bl);
        $this->db->set('HARGA_PERKG_BARANG_LOAK', $harga_bl);
        $this->db->set('STATUS_BARANG_LOAK', $status_bl);
        $this->db->where('ID_BARANG_LOAK', $id_BL);
        $this->db->update($this->table); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
        return true;
    }
}
