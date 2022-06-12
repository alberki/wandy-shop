<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends MY_Controller
{
    private $id;


    public function __construct()
    {
        parent::__construct();
        $is_login = $this->session->userdata('is_login');
        $this->id = $this->session->userdata('id');

        if (!$is_login) {
            redirect(base_url('/login'));
            return;
        }

        $this->load->model('product_model');
    }


    public function index()
    {
        $data['title'] = 'Keranjang Belanja';
        $data['content'] = $this->cart->select([
            'cart.id', 'cart.qty',
            'cart.subtotal', 'product.title',
            'product.image', 'product.price', 'product.weight'
        ])->join('product')
            ->where('cart.id_user', $this->id)
            ->get();
        $data['page'] = 'pages/cart/index';
        $this->view($data);
        return;
    }

    public function add()
    {
        if (!$_POST || $this->input->post('qty') < 1) {
            $this->session->set_flashdata('error', 'Produk tidak boleh kosong');
            redirect(base_url());
        } else {
            $input              = (object) $this->input->post(null, true);
            $this->cart->table  = 'product';
            $product            = $this->cart->where('id', $input->id_product)->first();
            $subtotal           = $product->price * $input->qty;
            $this->cart->table  = 'cart';
            $cart               = $this->cart->where('id_user', $this->id)->where('id_product', $input->id_product)->first();

            if ($cart) {
                $data = [
                    'qty'           => $cart->qty + $input->qty,
                    'subtotal'      => $cart->subtotal + $subtotal
                ];

                if ($this->cart->where('id', $cart->id)->update($data)) {
                    $this->session->set_flashdata('success', 'Produk berhasil di tambahkan');
                } else {
                    $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
                }
                redirect(base_url('/'));
            }
            $data = [
                'id_user'       => $this->id,
                'id_product'    => $input->id_product,
                'qty'           => $input->qty,
                'subtotal'      => $subtotal
            ];

            if ($this->cart->create($data)) {
                $this->session->set_flashdata('success', 'Produk berhasil di tambahkan');
                redirect(base_url('/'));
            } else {
                $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
            }
            redirect(base_url('/'));
        }
    }

    public function update($id)
    {
        if (!$_POST || $this->input->post('qty') < 1) {
            $this->session->set_flashdata('error', 'Produk tidak boleh kosong');
            redirect(base_url('cart'));
        }
        $data['content'] = $this->cart->where('id', $id)->first();
        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak di temukan!');
            redirect(base_url('cart'));
        }

        $data['input']      = (object) $this->input->post(null, true);
        $this->cart->table  = 'product';
        $product            = $this->cart->where('id', $data['content']->id_product)->first();

        $subtotal       = $data['input']->qty * $product->price;
        $cart           = [
            'qty'       => $data['input']->qty,
            'subtotal'  => $subtotal
        ];

        $this->cart->table  = 'cart';
        if ($this->cart->where('id', $id)->update($cart)) {
            $this->session->set_flashdata('success', 'Produk berhasil di tambahkan');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
        }
        redirect(base_url('cart'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('cart'));
        }

        if (!$this->cart->where('id', $id)->first()) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan!');
            redirect(base_url('cart'));
        }

        if ($this->cart->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
            redirect(base_url('cart'));
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus!');
            redirect(base_url('cart'));
        }
    }
}

/* End of file Cart.php */
