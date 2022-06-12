<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Myorder_model extends MY_Model
{

    public $table = 'orders';


    public function getDefaultValues()
    {
        return [
            'id_orders' => '',
            'account_name' => '',
            'account_number' => '',
            'nominal' => '',
            'note' => '',
            'image' => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'account_name',
                'label' => 'Nama Pemilik',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'account_number',
                'label' => 'No. Rekening',
                'rules' => 'trim|required|max_length[80]',
            ],
            [
                'field' => 'nominal',
                'label' => 'Nominal',
                'rules' => 'trim|required|numeric',
            ],
            [
                'field' => 'image',
                'label' => 'Bukti Transfer',
                'rules' => 'callback_image_required',
            ],
        ];

        return $validationRules;
    }

    public function upload_image($fieldName, $fileName)
    {
        $config = [
            'upload_path'       => './assets/images/confirm/',
            'file_name'         => $fileName,
            'allowed_types'     => 'jpg|png|gif|jpeg|JPG',
            'max_size'          => 2024,
            'max_witdh'         => 0,
            'max_height'        => 0,
            'overwrite'         => true,
            'file_ext_tolower'  => true,
        ];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($fieldName)) {
            return $this->upload->data();
        } else {
            $this->session->set_flashdata('image_error', $this->upload->display_errors('', ''));
            return false;
        }
    }

    public function deleteImage($fileName)
    {
        if (file_exists("./assets/images/confirm/$fileName")) {
            unlink("./assets/images/confirm/$fileName");
        }
    }

    // public function detail_data($invoice)
    // {

    // }
}

/* End of file Myorder_model.php */
