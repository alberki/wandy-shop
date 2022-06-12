<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends MY_Model
{

    public $table = 'cart';


    public function count_product()
    {
        $userId = $this->session->userdata('id');
        if ($userId) {
            $query = $this->db->where('id_user', $userId)->count_all_results('cart');
            return $query;
        }
    }
}

/* End of file Cart_model.php */
