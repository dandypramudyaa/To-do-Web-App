<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->ceklogin();
        $this->load->library('form_validation');
    }

    public function ceklogin()
    {

        if (!$this->session->userdata('email')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'My Profile';

        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => '*Name field is required!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('profile/index', $data);
            $this->load->view('templates/footer');
        } else {
            $nama  = $this->input->post('name');
            $email = $this->input->post('email');

            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('flash', 'changed');
            redirect('Profile');
        }
    }

    public function changepassword()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'My Profile';

        $this->form_validation->set_rules('old', 'Old Password', 'required|trim', [
            'required' => '*Old password field is required'
        ]);
        $this->form_validation->set_rules('new', 'New Password', 'required|trim|min_length[5]|matches[new1]', [
            'matches' => '*Passwords are not the same!',
            'min_length' => '*Password is too short!'
        ]);
        $this->form_validation->set_rules('new1', 'New Password', 'required|trim|matches[new]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('profile/changepassword');
            $this->load->view('templates/footer');
        } else {

            $new_password  = $this->input->post('new');
            $old_password  = $this->input->post('old');

            if (!password_verify($old_password, $data['user']['password'])) {
                $this->session->set_flashdata('flash_error', 'wrong');
                redirect('Profile/changepassword');
            } else {
                if ($old_password == $new_password) {
                    $this->session->set_flashdata('flash_error1', 'same');
                    redirect('Profile/changepassword');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('flash', 'successful');
                    redirect('Profile/changepassword');
                }
            }
        }
    }
}
