<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Todo extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->ceklogin();
        $this->load->library('form_validation');
        $this->load->model('Todo_model');
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
        $data['judul'] = 'To-do List';

        $data['todo'] = $this->Todo_model->getAllTodo($this->session->userdata('id_user'));

        $this->load->view('templates/header', $data);
        $this->load->view('todo/index', $data);
        $this->load->view('templates/footer');
    }

    public function new()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Add New To-do List';

        $this->form_validation->set_rules('task', 'Task', 'required|trim', [
            'required' => '*Name field is required!'
        ]);
        $this->form_validation->set_rules('date', 'Date', 'required|trim', [
            'required' => '*Date field is required!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('todo/new', $data);
            $this->load->view('templates/footer');
        } else {
            $date = $this->input->post('date');
            $task  = $this->input->post('task');

            $data = [
                'tanggal' => htmlspecialchars($date),
                'task' => htmlspecialchars($task),
                'id_user' => htmlspecialchars($data['user']['id_user']),
                'status' => 'Unfinished',
            ];

            $this->db->insert('tasklist', $data);
            $this->session->set_flashdata('flash', 'Successfully added!');
            redirect('Todo');
        }
    }

    public function finish($id)
    {;

        $this->db->set('status', 'Finished');
        $this->db->where('id_tasklist', $id);
        $this->db->update('tasklist');

        $this->session->set_flashdata('flash', 'Successfully finished!');
        redirect('Todo');
    }

    public function delete($id)
    {

        $this->db->where('id_tasklist', $id);
        $this->db->delete('tasklist');

        $this->session->set_flashdata('flash', 'Successfully deleted!');
        redirect('Todo');
    }
}
