<?php

class ModelMDMStatusTransaksi extends CI_model
{
    var $table = "status_transaksi";
    var $order = array('id_status_transaksi', 'nama_status_transaksi', 'st_status');

    private function _get_data_query()
    {
        $this->db->distinct();
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
            $this->db->like('id_status_transaksi', $searchValue);
            $this->db->or_like('nama_status_transaksi', $searchValue);
            $this->db->or_like('st_status', $searchValue);
        }

        //END OF SEARCH LOGIC

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_status_transaksi', 'ASC');
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

    public function tambahDataStatusTransaksi($nama_st, $status_st)
    {
        $getMaxID = $this->db->query("SELECT MAX(CAST(SUBSTRING(ID_STATUS_TRANSAKSI, 3, length(ID_STATUS_TRANSAKSI)-2) AS UNSIGNED))+1 AS ID FROM status_transaksi")->result_array();

        $data = array(
            'ID_STATUS_TRANSAKSI' => "ST" . $getMaxID['0']['ID'],
            'NAMA_STATUS_TRANSAKSI' => $nama_st,
            'ST_STATUS' => $status_st,
        );

        $this->db->insert($this->table, $data);
        return true;
    }

    public function getDataST($id_st)
    {
        $this->db->from('status_transaksi');
        $this->db->where("id_status_transaksi", $id_st);
        return $this->db->get()->first_row();
    }

    public function updateStatusTransaksi($id_st, $nama_st, $status_st)
    {
        $this->db->set('NAMA_STATUS_TRANSAKSI', $nama_st);
        $this->db->set('ST_STATUS', $status_st);
        $this->db->where('ID_STATUS_TRANSAKSI', $id_st);
        $this->db->update($this->table); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
        return true;
    }
}
