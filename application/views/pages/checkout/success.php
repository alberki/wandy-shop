<main role="main" class="container">
    <?php $this->load->view('layouts/_alert'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Checkout Berhasil
                </div>
            </div>
            <div class="card-body">
                <h5>Nomor Order : <?= $content->invoice; ?></h5>
                <p>Terimakasi sudah berbelanja</p>
                <p>Silakan Melakukan Pembayaran untuk kami proses selanjutnya</p>
                <ol>
                    <li>Lakukan Pembayaran Pada Rekening <strong> BRI/Alberki Rumbiak </strong></li>
                    <li>Sertakan Keterangan Dengan Nomor Order <strong> <?= $content->invoice; ?></strong></li>
                    <li>Total Pembayaran <strong>Rp<?= number_format($content->total_bayar, 0, ',', '.'); ?></strong></li>
                    <p>Jika Sudah, Silakan Kirim Bukti transfer di halaman konfirmasi atau bisa <a href="<?= base_url("myorder/detail/$invoice"); ?>">Klik
                            Disini!</a></p>
                    <a href="<?= base_url(); ?>" class="btn btn-primary"><i class="fas fa-angle-left"></i>Kembali</a>
                </ol>
            </div>

        </div>
    </div>


</main>