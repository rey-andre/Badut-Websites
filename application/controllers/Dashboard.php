<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('email')){
            $this->session->set_flashdata('message', 'Swal.fire("Mau ngapain??","Login dulu yeee!!!","error")');
            redirect('login');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $data['title'] = "Admin Dashboard";
        $this->load->view('dashboard/partials/header', $data);
        $this->load->view('dashboard/index');
        $this->load->view('dashboard/partials/footer');
    }

    public function profile()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "My Profile";
        $this->load->view('dashboard/partials/header', $data);
        $this->load->view('dashboard/profile');
        $this->load->view('dashboard/partials/footer');
    }

    public function editprofile()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Edit Profile";

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('instagram', 'Instagram', 'required|trim');

        if ($this->form_validation->run() == false){
            $this->load->view('dashboard/partials/header', $data);
            $this->load->view('dashboard/editprofile');
            $this->load->view('dashboard/partials/footer');
        } else {
            $name = $this->input->post('name');
            $instagram = $this->input->post('instagram');
            $email = $this->input->post('email');

            //cek jika ada gambar yg akan diupload
            $upload_image = $_FILES['image']['name'];

            if($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('image')){
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('dashboard/profile');
                }

            }

            $this->db->set('name', $name);
            $this->db->set('instagram', $instagram);
            $this->db->where('email', $email);
            $this->db->update('user');

            // $this->session->set_flashdata('alert', '<div class="alert alert-success shadow-sm" role="alert">Profile lu berhasil diedit! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
            // redirect('dashboard/profile');
            ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <body>
                <script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Profile lu berhasil diedit!!',
                    timer: 1500
                    }).then((result) => {
                        window.location='<?=base_url('dashboard/profile')?>';
                    })
                </script>
            </body>
            <?php
        }
    }

    public function changePassword()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Change Password";

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/partials/header', $data);
            $this->load->view('dashboard/changePassword');
            $this->load->view('dashboard/partials/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('password', '<div class="alert alert-danger shadow-sm" role="alert">Password yang sekarang SALAH! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
                redirect('dashboard/change-password');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('password', '<div class="alert alert-danger shadow-sm" role="alert">Ngapain lu ubah password kalo ngisinya sama kaya yang lama -_- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
                    redirect('dashboard/change-password');
                } else {
                    // password sudah aman
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    // $this->session->set_flashdata('password', '<div class="alert alert-success shadow-sm" role="alert">Aman cuyy password dah diganti <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
                    // redirect('dashboard/change-password');
                    ?>
                    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <body>
                        <script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Aman cuyy password dah diganti!',
                            timer: 1500
                            }).then((result) => {
                                window.location='<?=base_url('dashboard/change-password')?>';
                            })
                        </script>
                    </body>
                    <?php
                }
            }
        }
    }

    public function listBlog()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Blog_model');
        $data['blog'] = $this->Blog_model->get_all_blog();
        $data['title'] = "Blog";
        $this->load->view('dashboard/partials/header', $data);
        $this->load->view('dashboard/blog/list_blog');
        $this->load->view('dashboard/partials/footer');
    }

    public function tambahBlog()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Tambah Blog";

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('isi', 'Isi Tulisan', 'required');
        
        if ($this->form_validation->run() == false){
            $this->load->view('dashboard/partials/header', $data);
            $this->load->view('dashboard/blog/tambah_blog');
            $this->load->view('dashboard/partials/footer');
        } else {
            $judul = $this->input->post('judul');
            $isi = $this->input->post('isi');
            $gambar = str_replace(' ','_',$_FILES['gambar']['name']);
            $slug = strtolower(str_replace(' ', '-', $judul));
            $tanggal = time();
            $id_user = $data['user']['id'];

            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/blog';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('dashboard/blog');
            } else {
                $data = array(
                    'judul' => $judul,
                    'slug' => $slug,
                    'isi' => $isi,
                    'gambar' => $gambar,
                    'tanggal' => $tanggal,
                    'id_user' => $id_user,
                );
                $this->load->model('blog_model');
                $this->blog_model->add_blog($data);
                // $this->session->set_flashdata('alert', '<div class="alert alert-success shadow-sm" role="alert">Blog sudah terposting cuyyy! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
                // redirect('dashboard/blog');
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <body>
                    <script>
                        Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Blog berhasil diposting!',
                        timer: 1500
                        }).then((result) => {
                            window.location='<?=base_url('dashboard/blog')?>';
                        })
                    </script>
                </body>
                <?php
            }

        } 
    }

    public function editBlog($id)
    {
        $this->load->model('blog_model');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Edit Blog";
        $data['blog'] = $this->blog_model->get_blog_by_id($id);

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('isi', 'Isi Tulisan', 'required');
        
        if ($this->form_validation->run() == false){
            $this->load->view('dashboard/partials/header', $data);
            $this->load->view('dashboard/blog/edit_blog');
            $this->load->view('dashboard/partials/footer');
        } else{
            $judul = $this->input->post('judul');
            $isi = $this->input->post('isi');
            $slug = strtolower(str_replace(' ', '-', $judul));

            //cek jika ada gambar
            if (!empty($_FILES['gambar']['name'])){
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/blog/';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('gambar')){
                    $gambar = $this->upload->data('file_name');
                    
                    // hapus gambar lama jika ada
                    $blog = $this->blog_model->get_blog_by_id($id);
                    if (file_exists('./uploads/' . $blog->gambar)) {
                        unlink('./assets/img/blog/' . $blog->gambar);
                    }
                    // $data = array(
                    //     'judul' => $judul,
                    //     'isi' => $isi,
                    //     'gambar' => $gambar
                    // );
                    $this->blog_model->update($id, $judul, $slug, $isi, $gambar);
                } else {
                    $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('dashboard/blog/edit/'.$id);
                }
            } else {
                // $data = array(
                //     'judul' => $judul,
                //     'isi' => $isi
                // );
                $this->blog_model->update($id, $judul, $slug, $isi);
            }
            // $this->session->set_flashdata('alert_type', 'success');
            // $this->session->set_flashdata('alert_message', 'Blog berhasil diedit');
            // redirect('dashboard/blog');
            ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <body>
                <script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Blog berhasil diedit!',
                    timer: 1500
                    }).then((result) => {
                        window.location='<?=base_url('dashboard/blog')?>';
                    })
                </script>
            </body>
            <?php
        }
    }

    public function hapusBlog($id)
    {
        $this->load->model('blog_model');
        $this->blog_model->delete_file($id);
        $this->blog_model->delete($id);

        ?>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<body>
            <script>
                Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'Blog berhasil terhapus!',
                timer: 1500
                }).then((result) => {
                    window.location='<?=base_url('dashboard/blog')?>';
                })
			</script>
        </body>
		<?php
    }

    public function listMessage()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Pesan_model');
        $data['pesan'] = $this->Pesan_model->get_all_messages();

        $data['title'] = "Kontak Masuk";
        $this->load->view('dashboard/partials/header', $data);
        $this->load->view('dashboard/message');
        $this->load->view('dashboard/partials/footer');
    }

    public function hapusMessage($id)
    {
        $this->load->model('Pesan_model');
        $this->Pesan_model->delete($id);

        ?>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<body>
            <script>
                Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'Blog berhasil terhapus!',
                timer: 1500
                }).then((result) => {
                    window.location='<?=base_url('dashboard/messages')?>';
                })
			</script>
        </body>
		<?php
    }

}

/* End of file Dashboard.php */
