<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pesan_model');
        
    }

    public function index()
    {

        $this->load->model('Member_model');
        $data['users'] = $this->Member_model->get_all_users();
        $this->load->model('Blog_model');
        $data['blog'] = $this->Blog_model->get_all_blog();

        $data['title']= 'Home';

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('pesan', 'Pesan', 'required');

        if ($this->form_validation->run() == false){
            $this->load->view('front-end/partials/header', $data);
            $this->load->view('front-end/home');
            $this->load->view('front-end/contact');
            $this->load->view('front-end/partials/footer');
        } else {
            $this->load->model('Pesan_model');
            $data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'pesan' => $this->input->post('pesan'),
                'tanggal' => time()
            ];
            if ($this->Pesan_model->simpan_pesan($data)) {
                // Sukses menyimpan data
                $this->session->set_flashdata('pesan', 'n');
                redirect('/#contact');
            } else {
                // Gagal menyimpan data
                // Tambahkan logika gagal lainnya di sini
            }
        }

    }
    
    public function blog()
    {
        $data['title']= 'Blog';
        $this->load->model('Blog_model');
        
        $data['blog'] = $this->Blog_model->get_all_blog();
        $this->load->view('front-end/partials/header', $data);
        $this->load->view('front-end/blog');
        $this->load->view('front-end/contact');
        $this->load->view('front-end/partials/footer');
    }

    public function detailBlog($slug)
    {
        $this->load->model('Blog_model');
        $data['blog'] = $this->Blog_model->get_blog_by_slug($slug);
        $data['admin'] = $this->Blog_model->get_admin_by_id($data['blog']->id_user);
        $data['title']= 'Detail Blog';
        
        $this->load->view('front-end/partials/header', $data);
        $this->load->view('front-end/detail_blog');
        $this->load->view('front-end/contact');
        $this->load->view('front-end/partials/footer');
    }

}

/* End of file Frontend.php */
