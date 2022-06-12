<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');
        if ($role != 'admin') {
            redirect(base_url('/'));
            return;
        }
    }

    public function index($page = null)
    {
        $data['title'] = 'Settings';
        $data['content'] = $this->setting->select('*')->where('id', 1)->first();
        $data['page'] = 'pages/setting/index';
        $this->view($data);
    }

    public function edit()
    {
        $data['page'] = 'pages/setting/index';
        $this->view($data);
        $data =  [
            'id' => 1,
            'lokasi' => $this->input->post('kota'),
            'nama_toko' => $this->input->post('nama_toko'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('no_hp'),
        ];
        if ($this->setting->update($data)) {
            $this->session->set_flashdata('success', 'Data berhasil di Ubah');
        } else {
            $this->session->set_flashdata('error', 'Data gagal di Ubah');
        }

        redirect(base_url('setting'));
    }
}

/* End of file Setting.php */
