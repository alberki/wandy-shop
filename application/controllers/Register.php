<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Register extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $is_login = $this->session->userdata('is_login');

        if ($is_login) {
            redirect(base_url());
            return;
        }
    }


    public function index()
    {
        if (!$_POST) {
            $input = (object) $this->register->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->register->validate()) {
            $data['title'] = 'Register';
            $data['input'] = $input;
            // $data['page'] = 'pages/auth/register';
            $this->load->view('pages/auth/register', $data);
            return;
        }

        if ($this->register->run($input)) {
            $this->session->set_flashdata('success', 'Berhasi melakukan registrasi!');
            redirect(base_url());
        } else {
            $this->session->set_flashdata('erorr', 'Registrasi tidak berhasil!');
            redirect(base_url('/register'));
        }
    }
}

/* End of file Register.php */
