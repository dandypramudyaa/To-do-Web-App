<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            $this->login();
        }
    }

    private function login()
    {

        $email = $this->input->post('email');
        $pass = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // user terdaftar
        if ($user) {
            // cek password
            if (password_verify($pass, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'id_user' => $user['id_user']
                ];
                $this->session->set_userdata($data);
                redirect('Dashboard');
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
                     Wrong password!
                     </div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
              You are not registered yet!
            </div>');
            redirect('Auth');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('name', 'Name', 'required', [
            'required' => '*Name field is required!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => '*Email field is required!',
            'is_unique' => '*Email already registered'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
            'required' => '*Password field is required!',
            'matches' => '*Passwords are not the same!',
            'min_length' => '*Password is too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/register');
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $data = [

                'nama' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password1', true), PASSWORD_DEFAULT),
                'tanggal_daftar' => time(),
            ];

            // var_dump($data);

            $this->db->insert('user', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
              Congratulations! You are already registered.
            </div>');
            redirect('Auth');
        }
    }

    public function logout()
    {

        $this->session->unset_userdata('email');
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
              You have successfully logged out!
            </div>');
        redirect('Auth');
    }
}
