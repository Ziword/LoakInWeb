<?php

class ModelMDMJenisUser extends CI_model
{
    var $table = "jenis_user";
    var $order = array('id_jenis_user', 'nama_jenis_user', 'ju_status');

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
            $this->db->like('id_jenis_user', $searchValue);
            $this->db->or_like('nama_jenis_user', $searchValue);
            $this->db->or_like('ju_status', $searchValue);
        }

        //END OF SEARCH LOGIC

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_jenis_user', 'ASC');
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

    public function tambahDataJenisUser($nama_ju, $status_ju)
    {
        $getMaxID = $this->db->query("SELECT MAX(CAST(SUBSTRING(ID_JENIS_USER, 2, length(ID_JENIS_USER)-1) AS UNSIGNED))+1 AS ID FROM jenis_user")->result_array();

        $data = array(
            'ID_JENIS_USER' => "U" . $getMaxID['0']['ID'],
            'NAMA_JENIS_USER' => $nama_ju,
            'JU_STATUS' => $status_ju,
        );
        $this->db->insert($this->table, $data);
        return true;
    }

    public function getDataJU($id_ju)
    {
        $this->db->from("jenis_user");
        $this->db->where("ID_JENIS_USER", $id_ju);
        return $this->db->get()->first_row();
    }

    public function updateJenisUser($id_ju, $nama_ju, $status_ju)
    {
        $this->db->set('NAMA_JENIS_USER', $nama_ju);
        $this->db->set('JU_STATUS', $status_ju);
        $this->db->where('ID_JENIS_USER', $id_ju);
        $this->db->update($this->table); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
        return true;
    }
}
