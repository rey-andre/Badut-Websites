<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan_model extends CI_Model {

  public function simpan_pesan($data)
  {
    return $this->db->insert('tbl_pesan', $data);
  }

  public function get_all_messages() {
    $this->db->select('*');
    $this->db->from('tbl_pesan');
    $query = $this->db->get();
    return $query->result();
  }

  public function delete($id)
    {
      $this->db->where('id', $id);
      $this->db->delete('tbl_pesan');
      return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }


}

/* End of file Pesan_model.php */
/* Location: ./application/models/Pesan_model.php */