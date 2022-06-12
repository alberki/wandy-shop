<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Checkout_model extends MY_Model
{

    public $table = 'orders';

    public function getDefaultValues()
    {
        return [
            'name'        => '',
            'address'    => '',
            'phone'        => '',
            'status'    => '',
            'provinsi'    => '',
            'kota'    => '',
            'kode_pos'    => '',
            'ekspedisi'    => '',
            'paket'    => '',
            'estimasi'    => '',
            'total_bayar'    => '',
            'ongkir'    => '',
            'berat'    => '',
            'address'    => '',
            'phone'        => '',
            'status'    => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field'    => 'name',
                'label'    => 'Nama',
                'rules'    => 'trim|required'
            ],
            [
                'field'    => 'address',
                'label'    => 'Alamat',
                'rules'    => 'trim|required'
            ],
            [
                'field'    => 'phone',
                'label'    => 'Telepon',
                'rules'    => 'trim|required|max_length[15]'
            ],
            [
                'field'    => 'provinsi',
                'label'    => 'Provinsi',
                'rules'    => 'trim|required'
            ],
            [
                'field'    => 'kota',
                'label'    => 'Kota',
                'rules'    => 'trim|required'
            ],
            [
                'field'    => 'kode_pos',
                'label'    => 'Kode Pos',
                'rules'    => 'trim|required'
            ],
            [
                'field'    => 'ekspedisi',
                'label'    => 'Ekspedisi',
                'rules'    => 'trim|required'
            ],
        ];

        return $validationRules;
    }
}

/* End of file Checkout_model.php */
