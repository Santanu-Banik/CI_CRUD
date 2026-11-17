<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url', 'form'));
        $this->load->model('user_model');
        $this->load->library('session');
    }

    // ========== AUTHENTICATION ==========

    public function login()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('login');
    }

    public function login_process()
    {
        $email    = $this->input->post('email');
        $password = md5($this->input->post('password'));

        $user = $this->user_model->login($email, $password);

        if ($user) {
            $session_data = array(
                'user_id'    => $user->id,
                'user_name'  => $user->name,
                'user_email' => $user->email,
                'user_image' => $user->image,
                'logged_in'  => TRUE
            );
            $this->session->set_userdata($session_data);
            $this->session->set_flashdata('success', 'Welcome back, ' . $user->name . '!');
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid Email or Password');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'You have been logged out successfully.');
        redirect('login');
    }

    // ========== PROTECTED AREA ==========

    public function dashboard()
    {
        $this->check_login();
        $data['user']  = $this->user_model->get_user($this->session->userdata('user_id'));
        $data['users'] = $this->user_model->display_data();
        $this->load->view('dashboard', $data);
    }

    public function index()
    {
        $this->check_login();
        $data['users'] = $this->user_model->display_data();
        $this->load->view('show', $data);
    }

    public function register()
    {
        $this->load->view('register');
    }

    public function save_user()
    {
        date_default_timezone_set('Asia/Kolkata');

        if ($this->input->post('b1')) {
            $user_id    = $this->input->post('id');
            $user_name  = $this->input->post('name');
            $user_dob   = $this->input->post('dob');
            $user_mob   = $this->input->post('mob');
            $user_email = $this->input->post('email');
            $user_pass  = $this->input->post('pass');
            $current_time = date('Y-m-d H:i:s');

            if ($this->user_model->email_exists($user_email)) {
                $this->session->set_flashdata('error', 'Email already registered!');
                redirect('register');
            }

            $image_name = NULL;
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']      = 2048;
                $config['file_name']     = time() . '_' . $_FILES['image']['name'];

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $image_name  = $upload_data['file_name'];
                } else {
                    $data['error'] = $this->upload->display_errors();
                    $this->load->view('register', $data);
                    return;
                }
            }

            $this->user_model->save_data(
                $user_id,
                $user_name,
                $user_dob,
                $user_mob,
                $user_email,
                md5($user_pass),
                $image_name,
                $current_time
            );

            $this->session->set_flashdata('success', 'Registration successful! Please login.');
            redirect('login');
        }
    }

    public function edit($id)
    {
        $this->check_login();
        $data['user'] = $this->user_model->get_user($id);
        if (!$data['user']) {
            show_404();
        }
        $this->load->view('edit', $data);
    }

    public function update_user()
    {
        $this->check_login();

        if ($this->input->post('b1')) {
            $user_id    = $this->input->post('id');
            $user_name  = $this->input->post('name');
            $user_dob   = $this->input->post('dob');
            $user_mob   = $this->input->post('mob');
            $user_email = $this->input->post('email');

            $current_user = $this->user_model->get_user($user_id);
            $image_name   = $current_user->image;

            if (!empty($_FILES['image']['name'])) {
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']      = 2048;
                $config['file_name']     = time() . '_' . $_FILES['image']['name'];

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    if (
                        !empty($current_user->image) &&
                        file_exists('./uploads/' . $current_user->image)
                    ) {
                        unlink('./uploads/' . $current_user->image);
                    }
                    $upload_data = $this->upload->data();
                    $image_name  = $upload_data['file_name'];
                } else {
                    $data['user']  = $current_user;
                    $data['error'] = $this->upload->display_errors();
                    $this->load->view('edit', $data);
                    return;
                }
            }

            $this->user_model->update_data(
                $user_id,
                $user_name,
                $user_dob,
                $user_mob,
                $user_email,
                $image_name
            );

            if ($this->session->userdata('user_id') == $user_id) {
                $this->session->set_userdata(array(
                    'user_name'  => $user_name,
                    'user_email' => $user_email,
                    'user_image' => $image_name
                ));
            }

            $this->session->set_flashdata('success', 'Record updated successfully.');
            redirect('users');
        }
    }

    public function delete($id)
    {
        $this->check_login();
        $user = $this->user_model->get_user($id);
        if ($user) {
            if (!empty($user->image) && file_exists('./uploads/' . $user->image)) {
                unlink('./uploads/' . $user->image);
            }
            $this->user_model->delete_data($id);
            $this->session->set_flashdata('success', 'Record deleted successfully.');
        }
        redirect('users');
    }

    private function check_login()
    {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Please login to access this page.');
            redirect('login');
        }
    }
}
