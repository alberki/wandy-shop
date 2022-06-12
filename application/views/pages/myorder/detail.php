<main role="main" class="container">
    <?php $this->load->view('layouts/_alert'); ?>
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header">
                    Menu
                </div>
                <div class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="profil.html">Profil</a>
                    </li>
                    <li class="list-group-item">
                        <a href="orders.html">Orders</a>
                    </li>
                </div>

            </div>

        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Detail Orders #<?= $order->invoice; ?>
                    <div class="float-right">
                        <?php $this->load->view('layouts/_status', ['status' => $order->status]); ?>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-resposive table-borderless">
                        <tr>
                            <td>Tanggal </td>
                            <td>: <?= str_replace('-', '/', date("d-m-Y", strtotime($order->date))); ?></td>
                        </tr>
                        <tr>
                            <td>Nama </td>
                            <td>: <?= $order->name; ?></td>
                        </tr>
                        <tr>
                            <td>Telepon </td>
                            <td>: <?= $order->phone; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat </td>
                            <td>: <?= $order->address; ?></td>
                        </tr>
                        <tr>
                            <td>Provinsi </td>
                            <td>: <b>di kirim ke</b> - <?= $order->provinsi; ?></td>
                        </tr>
                        <tr>
                            <td>Kota </td>
                            <td>: <?= $order->kota; ?></td>
                        </tr>
                        <tr>
                            <td>Ekspedisi </td>
                            <td>: <?= $order->ekspedisi; ?></td>
                        </tr>
                        <tr>
                            <td>Paket </td>
                            <td>: <?= $order->paket; ?></td>
                        </tr>
                        <tr>
                            <td>Status </td>
                            <td>: <span class="badge badge-primary"><?= $order->status; ?></span></td>
                        </tr>
                        <tr>
                            <td>Alamat </td>
                            <td>: <?= $order->address; ?></td>
                        </tr>
                    </table>

                    <table class="table">
                        <div class="thead">
                            <tr>
                                <th>Gambar</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">SubTotal</th>
                            </tr>
                        </div>
                        <div class="tbody">
                            <?php foreach ($order_detail as $row) : ?>
                                <tr>
                                    <td>
                                        <p>
                                            <img src="<?= $row->image ? base_url("assets/images/product/$row->image") : base_url('assets/images/product/default.jpg'); ?>" alt="" class="rounded" width="30%" height="30%">
                                        </p>
                                    </td>
                                    <td><?= $row->title; ?></td>
                                    <td class="text-center">Rp<?= number_format($row->price, 0, ',', '.'); ?></td>
                                    <td class="text-center"><?= $row->qty; ?></td>
                                    <td class="text-center">Rp<?= number_format($row->subtotal, 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3"> <strong>Total: </strong></td>
                                <td class="text-center"><strong>Rp<?= number_format(array_sum(array_column($order_detail, 'subtotal')), 0, ',', '.'); ?></strong></td>
                            </tr>
                        </div>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url("myorder/confirm/$order->invoice"); ?>" class="btn btn-success">Konfirmasi Pembayaran</a>
                </div>
            </div>


            <!-- order bukti transfer -->
            <?php if (isset($order_confirm)) : ?>
                <div class="row mb-3 mt-5">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-header">
                                Bukti Transfer
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Dari Rekening </td>
                                        <td>: <?= $order_confirm->account_number; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Atas Nama </td>
                                        <td>: <?= $order_confirm->account_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nominal </td>
                                        <td>: Rp<?= number_format($order_confirm->nominal, 0, ',', '.'); ?>,-</td>
                                    </tr>
                                    <tr>
                                        <td>Catatan </td>
                                        <td>: <?= $order_confirm->note; ?> -</td>
                                    </tr>
                                    <tr>
                                        <td>Bukti</td>
                                        <td>
                                            <img src="<?= base_url("assets/images/confirm/$order_confirm->image"); ?>" alt="" height="30%" width="30%" class="rounded">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>



</main>