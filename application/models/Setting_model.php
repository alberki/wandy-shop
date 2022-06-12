<?php




defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends MY_Model
{
    protected $table = 'setting';
    public function getDefaultValues()
    {
        return [
            'id' => '',
            'nama_toko' => '',
            'alamat' => '',
            'lokasi' => '',
            'no_hp' => '',
        ];
    }


    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama_toko',
                'label' => 'Nama Toko',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'lokasi',
                'label' => 'Lokasi',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'no_hp',
                'label' => 'No Hp',
                'rules' => 'trim|required',
            ],
        ];

        return $validationRules;
    }

    public function getdata($id)
    {
        $data = $this->setting->where('id', $id)->first();
        return $data;
    }

    public function data_setting()
    {
        $this->db->select('*');
        $this->db->from('setting');
        $this->db->where('id', 1);
        return $this->db->get()->row();
    }
}

/* End of file Setting_model.php */
