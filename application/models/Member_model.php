<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Member_model extends CI_Model {

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function get_all_users()
  {
    $query = $this->db->get('user');
    return $query->result();
  }

  // ------------------------------------------------------------------------

}

/* End of file Member_model.php */
/* Location: ./application/models/Member_model.php */