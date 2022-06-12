<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends MY_Model
{

    protected $table = 'user';

    public function getDefaultValues()
    {
        return [
            'name' => '',
            'email' => '',
            'image' => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'name',
                'label' => 'Nama',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'trim|required|valid_email|callback_unique_email',
            ]
        ];

        return $validationRules;
    }

    public function upload_image($fieldName, $fileName)
    {
        $config = [
            'upload_path'       => './assets/images/user/',
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
        if (file_exists("./assets/images/user/$fileName")) {
            unlink("./assets/images/user/$fileName");
        }
    }
}

/* End of file Profile_model.php */
