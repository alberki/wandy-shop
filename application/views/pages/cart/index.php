<style>
    .card-mb-3>.card-body>.table>tbody>tr>* {
        vertical-align: middle;
    }
</style>
<main role="main" class="container">
    <?php $this->load->view('layouts/_alert'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card-mb-3">
                <div class="card-header" style="background-color: #4c1130; color:#fff;">
                    Keranjang Belanja
                </div>
                <div class="card-body">
                    <table class="table">
                        <div class="thead">
                            <tr>
                                <th>Gambar</th>
                                <th>Produk</th>
                                <th>Berat</th>
                                <th>Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">SubTotal</th>
                                <th></th>
                            </tr>
                        </div>
                        <div class="tbody">
                            <?php
                            $tot_weight = 0;
                            foreach ($content as $row) {
                                $weight = $row->qty * $row->weight;
                                $tot_weight = $weight + $tot_weight;

                            ?>

                                <tr>
                                    <td>
                                        <img src="<?= $row->image ? base_url("assets/images/product/$row->image") : base_url('assets/images/product/default.jpg'); ?>" alt="" width="20%" height="20%">
                                    </td>
                                    <td>
                                        <strong><?= $row->title; ?></strong>
                                    </td>
                                    <td>
                                        <?= $weight; ?> (Gr)
                                    </td>
                                    <td class="text-center">Rp<?= number_format($row->price, 0, ',', '.'); ?></td>
                                    <td>
                                        <form action="<?= base_url("cart/update/$row->id"); ?>" method="POST">
                                            <input type="hidden" name="id" value="<?= $row->id; ?>">
                                            <div class="input-group">
                                                <input type="number" name="qty" class="form-control text-center" value="<?= $row->qty; ?>">
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" type="submit"><i class="fas fa-check" aria-hidden="true"></i></button>
                                                </div>

                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-center">Rp<?= number_format($row->subtotal, 0, ',', '.'); ?></td>
                                    <td>
                                        <form action="<?= base_url("cart/delete/$row->id"); ?>" method="POST">
                                            <input type="hidden" name="id" value="<?= $row->id; ?>">
                                            <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3"> <strong> Sub Total: </strong></td>
                                <td class="text-center"><strong>Rp<?= number_format(array_sum(array_column($content, 'subtotal')), 0, ',', '.'); ?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="3"> <strong> Total Berat: </strong></td>
                                <td class="text-center"><strong><?= $tot_weight; ?></strong></td>
                            </tr>
                        </div>
                    </table>
                </div>
                <div class="card-footer" style="background-color: #4c1130; color:#fff;">
                    <a href="<?= base_url('checkout'); ?>" class="btn btn-success float-right">Pembayaran <i class="fas fa-angle-right"></i></a>
                    <a href="<?= base_url(); ?>" class="btn btn-warning text-white"> <i class="fas fa-angle-left"></i>
                        Kembali Belanja</a>
                </div>
            </div>
        </div>
    </div>
</main>