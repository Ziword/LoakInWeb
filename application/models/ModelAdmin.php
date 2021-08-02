<?php defined('BASEPATH') or exit('No direct script access allowed');

class ModelAdmin extends CI_Model
{
    private $_table = "admin";

    public function doLogin($username, $password)
    {
        // cari user berdasarkan email dan username
        $this->db->where('USERNAME_ADMIN', $username);
        $user = $this->db->get($this->_table)->row_array();

        // jika user terdaftar
        if ($user) {
            // periksa password-nya
            if ($password == $user['PASSWORD_ADMIN']) {
                return true;
            } else {
                return false;
            }
        }

        // login gagal
        return false;
    }

    public function getDataUser($username)
    {
        $this->db->where('USERNAME_ADMIN', $username);
        $user = $this->db->get($this->_table)->row_array();
        return $user;
    }
}
