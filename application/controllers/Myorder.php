<?php

defined('BASEPATH') or exit('No direct script access allowed');
// require_once APPPATH . 'assets\vendor\autoload.php';



class Myorder extends MY_Controller
{

    private $id;
    public function __construct()
    {
        parent::__construct();
        $is_login = $this->session->userdata('is_login');
        $this->id = $this->session->userdata('id');


        if (!$is_login) {
            redirect(base_url('/'));
            return;
        }
    }
    public function index()
    {
        $data['title'] = 'Daftar Order';
        $data['content'] = $this->myorder->where('id_user', $this->id)->orderBy('date', 'DESC')->get();
        $data['page']  = 'pages/myorder/index';

        $this->view($data);
    }

    public function detail($invoice)
    {

        $data['order'] = $this->myorder->where('invoice', $invoice)->first();
        if (!$data['order']) {
            $this->session->set_flashdata('warning', 'Data tidak di temukan!');
            redirect(base_url('myorder'));
        }

        $this->myorder->table = 'orders_detail';
        $data['order_detail'] = $this->myorder->select([
            'orders_detail.id_orders', 'orders_detail.id_product', 'orders_detail.qty',
            'orders_detail.subtotal', 'product.title', 'product.image', 'product.price', 'orders.estimasi', 'orders.ekspedisi', 'orders.provinsi', 'orders.kota', 'orders.status', 'orders.paket', 'orders.address'
        ])->join('product')
            ->where('orders_detail.id_orders', $data['order']->id)->join('orders')->where('orders_detail.id_orders', $data['order']->id)
            ->get();

        if ($data['order']->status !== 'waiting') {
            $this->myorder->table = 'orders_confirm';
            $data['order_confirm'] = $this->myorder->where('id_orders', $data['order']->id)->first();
        }
        $data['page'] = 'pages/myorder/detail';
        $this->view($data);
    }

    public function confirm($invoice)
    {
        $data['order'] = $this->myorder->where('invoice', $invoice)->first();
        if (!$data['order']) {
            $this->session->set_flashdata('warning', 'Data tidak di temukan!');
            redirect(base_url('myorder'));
        }

        if ($data['order']->status !== 'waiting') {
            $this->session->set_flashdata('warning', 'Bukti Transfer sudah terkirim');
            redirect(base_url("myorder/detail/$invoice"));
        }

        if (!$_POST) {
            $data['input'] = (object) $this->myorder->getDefaultValues();
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] != '') {
            $imageName = url_title($invoice, '_', true) . '_' . date('YmdHis');
            $upload = $this->myorder->upload_image('image', $imageName);

            if ($upload) {
                $data['input']->image = $upload['file_name'];
            } else {
                redirect(base_url("myorder/confirm/$invoice"));
            }
        }


        if (!$this->myorder->validate()) {
            $data['title'] = 'Konfirmasi Order';
            $data['form_action'] = base_url("myorder/confirm/$invoice");
            $data['page'] = 'pages/myorder/confirm';
            $this->view($data);
            return;
        }

        $this->myorder->table = 'orders_confirm';
        // unset($data['input']->invoice);
        if ($this->myorder->create($data['input'])) {
            $this->myorder->table = 'orders';
            $this->myorder->where('id', $data['input']->id_orders)->update(['status' => 'paid']);
            $this->session->set_flashdata('success', 'Data Produk berhasil di tambahkan');
        } else {
            $this->session->set_flashdata('error', 'Data Produk gagal di tambahkan');
        }

        redirect(base_url("myorder/detail/$invoice"));
    }

    public function image_required()
    {
        if (empty($_FILES) || $_FILES['image']['name'] === '') {
            $this->session->set_flashdata('image_error', 'Bukti Transfer Tidak Boleh Kosong');
            return false;
        }
        return true;
    }

    // public function viewpdf($invoice)
    // {
    //     $data['order'] = $this->myorder->where('invoice', $invoice)->first();

    //     $this->myorder->table = 'orders_detail';
    //     $data['order_detail'] = $this->myorder->select([
    //         'orders_detail.id_orders', 'orders_detail.id_product', 'orders_detail.qty',
    //         'orders_detail.subtotal', 'product.title', 'product.image', 'product.price', 'orders.estimasi', 'orders.ekspedisi', 'orders.provinsi', 'orders.kota', 'orders.status', 'orders.paket', 'orders.address'
    //     ])->join('product')
    //         ->where('orders_detail.id_orders', $data['order']->id)->join('orders')->where('orders_detail.id_orders', $data['order']->id)
    //         ->get();



    //     $view['pages'] = $this->view('pages/myorder/viewpdf', [
    //         'order' => $data
    //     ]);
    //     // instantiate and use the dompdf class
    //     $dompdf = new Dompdf();
    //     $dompdf->loadHtml($view);

    //     // (Optional) Setup the paper size and orientation
    //     $dompdf->setPaper('A4', 'potrait');

    //     // Render the HTML as PDF
    //     $dompdf->render();

    //     // Output the generated PDF to Browser
    //     $dompdf->stream("order-detail", array("Attachment" => false));
    // }
}
/* End of file Myorder.php */
