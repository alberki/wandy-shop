<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends MY_Model
{
    protected $table = 'product';
    public function getDefaultValues()
    {
        return [
            'id_category' => '',
            'slug' => '',
            'title' => '',
            'description' => '',
            'price' => '',
            'is_available' => 1,
            'image' => '',
            'weight' => '',
            'stock' => '',
        ];
    }


    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'id_category',
                'label' => 'Kategori',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'slug',
                'label' => 'Slug',
                'rules' => 'trim|required|callback_unique_slug',
            ],
            [
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'description',
                'label' => 'Deskripsi',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'price',
                'label' => 'Harga',
                'rules' => 'trim|required|numeric',
            ],
            [
                'field' => 'is_available',
                'label' => 'Ketersediaan',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'image',
                'label' => 'Gambar Produk',
                'rules' => 'trim|is_image',
            ],
            [
                'field' => 'weight',
                'label' => 'Berat Barang',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'stock',
                'label' => 'Stok Barang',
                'rules' => 'trim|required',
            ],
        ];

        return $validationRules;
    }

    public function upload_image($fieldName, $fileName)
    {
        $config = [
            'upload_path'       => './assets/images/product/',
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
        if (file_exists("./assets/images/product/$fileName")) {
            unlink("./assets/images/product/$fileName");
        }
    }

    public function data_product($id)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
}

/* End of file Product_model.php */
