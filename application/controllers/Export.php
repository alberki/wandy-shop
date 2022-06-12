<?php



defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Export extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Export_model');
        $this->load->model('Myorder_model');
    }


    public function viewpdf($invoice)
    {

        $data['order'] = $this->Myorder_model->where('invoice', $invoice)->first();

        $this->Myorder_model->table = 'orders_detail';
        $data['order_detail'] = $this->Myorder_model->select([
            'orders_detail.id_orders', 'orders_detail.id_product', 'orders_detail.qty',
            'orders_detail.subtotal', 'product.title', 'product.image', 'product.price', 'orders.estimasi', 'orders.ekspedisi', 'orders.provinsi', 'orders.kota', 'orders.status', 'orders.paket', 'orders.address'
        ])->join('product')
            ->where('orders_detail.id_orders', $data['order']->id)->join('orders')->where('orders_detail.id_orders', $data['order']->id)
            ->get();

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $view = $this->load->view('pages/myorder/viewpdf', $data);
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("order-detail", array("Attachment" => false));
    }
}

/* End of file Export.php */
