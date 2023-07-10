<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if($this->session->userdata('email')){
            redirect('dashboard');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if($this->form_validation->run() == false) {
            $data['title']= "Login Admin";
            $this->load->view('auth/partials/header', $data);
            $this->load->view('auth/login');
            $this->load->view('auth/partials/footer');
        } else{
            //validasi sukses
            $this->_login();
        }
    }


    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        //jika usernya ada
        if($user){
            //jika aktif
            if($user['is_active'] == 1){
                //cek password
                if(password_verify($password, $user['password'])){
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                    ];
                    $this->session->set_userdata($data);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('message', 'Swal.fire("Gagal Login","Password salah!","error")');
                    redirect('login');
                }


            } else {
                $this->session->set_flashdata('message', 'Swal.fire("Gagal Login","Akun lu ga aktif!","error")');
                redirect('login');
            }
        } else{
            $this->session->set_flashdata('message', 'Swal.fire("Gagal Login","Email lu ga terdaftar!","error")');
            redirect('login');
        }
    }

    
    public function registration()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'emailnya udah ada yang make'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'passwordnya ga sama woii!',
            'min_length' => 'passwordnya minimal 6'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if($this->form_validation->run() == false) {
            $data['title']= "Register Admin";
            $this->load->view('auth/partials/header', $data);
            $this->load->view('auth/registration');
            $this->load->view('auth/partials/footer');
        } else{
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'instagram' => '',
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('blogedit', 'Data blog berhasil diedit');
            redirect('login');
        }
    }
    
    public function logout()
    {   
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', 'Swal.fire("Logout","Berhasil logout!","success")');
        redirect('login');
    }

}

/* End of file Auth.php */
