<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Blog_model extends CI_Model {

  public function get_all_blog() {
    $query=$this->db->get('tbl_blog');
    $this->db->select('tbl_blog.*, user.name');
    $this->db->from('tbl_blog');
    $this->db->join('user', 'tbl_blog.id_user = user.id');
    return $this->db->get()->result();
  }

  public function add_blog($data) {
    $this->db->insert('tbl_blog', $data);
  }

  public function get_blog_by_id($id){
    $this->db->where('id', $id);
    $query = $this->db->get('tbl_blog');
    return $query->row();
  }
  public function update($id, $judul, $slug, $isi, $gambar = null)
    {
        $data = [
            'judul' => $judul,
            'isi' => $isi,
            'slug' => $slug
        ];

        if ($gambar) {
            $data['gambar'] = $gambar;

            // hapus file gambar yang lama
            $blog = $this->get_blog_by_id($id);
            if (file_exists(FCPATH . 'assets/img/blog/' . $blog->gambar)) {
                unlink(FCPATH . 'assets/img/blog/' . $blog->gambar);
            }
        }

        $this->db->where('id', $id);
        return $this->db->update('tbl_blog', $data);
    }

    public function delete($id)
    {
      $this->db->where('id', $id);
      $this->db->delete('tbl_blog');
      return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    public function delete_file($id)
    {
      $blog = $this->get_blog_by_id($id);
      $file = $blog->gambar;
      unlink(FCPATH . 'assets/img/blog/'.$file);
    }

    public function get_blog_by_slug($slug) {
      $this->db->where('slug', $slug);
      $query = $this->db->get('tbl_blog');
      return $query->row();
    }

    public function get_admin_by_id($id_user)
    {
      $this->db->select('name');
      $this->db->from('user');
      $this->db->where('id', $id_user);
      $query = $this->db->get();
      return $query->row();
    }
}

/* End of file Blog_model.php */
/* Location: ./application/models/Blog_model.php */