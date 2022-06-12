<main role="main" class="container-fluid">
    <?php $this->load->view('layouts/_alert'); ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Formulir Alamat Pengiriman
                </div>
                <?php
                $tot_weight = 0;
                $weight = $cart[0]->qty * $cart[0]->weight;
                $tot_weight = $weight + $tot_weight;
                ?>
                <div class="card-body">
                    <form action="<?= base_url("checkout/create"); ?>" method="POST">
                        <div class="form-group">
                            <label for="">Nama :</label>
                            <input type="text" class="form-control" name="name" id="" placeholder="Masukan Nama Penerima.." value="<?= $input->name; ?>">
                            <?= form_error('name'); ?>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="provinsi">Provinsi</label>
                                <select name="provinsi" id="provinsi" class="form-control">
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="kota">Kabupaten / Kota</label>
                                <select name="kota" id="kota" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="ekspedisi">Ekspedisi</label>
                                <select name="ekspedisi" id="ekspedisi" class="form-control">
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="paket">Paket</label>
                                <select name="paket" id="paket" class="form-control">
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="">Detail alamat</label>
                            <textarea class="form-control" name="address" cols="30" id="" rows="5"><?= $input->address; ?></textarea>
                            <?= form_error('address'); ?>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Telepon</label>
                                <input type="text" class="form-control" name="phone" id="" placeholder="Masukan No Telepon Penerima.." value="<?= $input->phone; ?>">
                                <?= form_error('phone'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="">Kode Pos</label>
                                <input type="text" class="form-control" name="kode_pos" id="" placeholder="Masukan Kode Pos.." value="<?= $input->kode_pos; ?>">
                                <?= form_error('kode_pos'); ?>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-8">
                                    <input type="hidden" name="estimasi" value="<?= $input->estimasi; ?>">
                                    <input type="hidden" name="ongkir" value="<?= $input->ongkir; ?>">
                                    <input type="hidden" name="berat" value="<?= $tot_weight; ?>">
                                    <input type="hidden" name="total_bayar" value="<?= $input->total_bayar; ?>">
                                </div>
                            </div>


                        </div>
                        <button class="btn btn-primary" type="submit">Simpan</button>

                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        Cart
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Berat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tot_weight = 0;
                                foreach ($cart as $row) {
                                    $weight = $row->qty * $row->weight;
                                    $tot_weight = $weight + $tot_weight;

                                ?>

                                    <tr>
                                        <td><?= $row->title; ?></td>
                                        <td><?= $row->qty; ?></td>
                                        <td>Rp<?= number_format($row->price, 0, ',', '.'); ?></td>
                                        <td><label for=""><?= $row->weight; ?> (Gr)</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Subtotal</td>
                                        <td>Rp<?= number_format($row->subtotal, 0, ',', '.'); ?></td>
                                        <td><?= $tot_weight; ?> (Gr)</td>
                                    </tr>
                                <?php }; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Grand Total</th>
                                    <th>
                                        <?= number_format(array_sum(array_column($cart, 'subtotal')), 0, ',', '.'); ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">Ongkir</th>
                                    <th>
                                        <label id="ongkir"></label>
                                    </th>
                                </tr>

                                </tr>
                                <tr>
                                    <th colspan="2">Total</th>
                                    <th id="total_bayar"></th>
                                    <th>
                                        <?= $tot_weight; ?> (Gr)
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- Ajax Provinsi & Kota -->
        <script type="text/javascript">
            $(document).ready(function() {

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('rajaongkir/provinsi') ?>",
                    success: function(hasil_provinsi) {
                        // console.log(hasil_provinsi);
                        $("select[name=provinsi]").html(hasil_provinsi);
                    }
                });

                // KOta
                $("select[name=provinsi]").on("change", function() {

                    var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");

                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('rajaongkir/kota') ?>",
                        data: 'id_provinsi=' + id_provinsi_terpilih,
                        success: function(hasil_kota) {
                            // console.log(hasil_kota);
                            $("select[name=kota]").html(hasil_kota);

                        }

                    });
                });

                // ekspedisi
                $("select[name=kota]").on("change", function() {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('rajaongkir/ekspedisi') ?>",
                        success: function(hasil_ekspedisi) {
                            // console.log(hasil_ekspedisi);
                            $("select[name=ekspedisi]").html(hasil_ekspedisi);
                        }
                    });
                });

                // paket
                $("select[name=ekspedisi]").on("change", function() {
                    // ekspedisi terpilih
                    var ekspedisi_terpilih = $("select[name=ekspedisi]").val();
                    // id kota tjuan terpilih
                    var id_kota_tujuan_terpilih = $("option:selected", "select[name=kota]").attr('id_kota');

                    // data ongkos kirim
                    var total_berat = <?= $row->weight ?>;

                    $.ajax({
                        type: "POST",
                        data: 'ekspedisi=' + ekspedisi_terpilih + '&id_kota=' + id_kota_tujuan_terpilih + '&weight=' + total_berat,
                        url: "<?= base_url('rajaongkir/paket') ?>",
                        success: function(hasil_paket) {
                            // console.log(hasil_paket);
                            $("select[name=paket]").html(hasil_paket);
                        }
                    });

                });

                $("select[name=paket]").on("change", function() {
                    var dataongkir = $("option:selected", this).attr('ongkir');
                    var reverse = dataongkir.toString().split('').reverse().join(''),
                        ribuan_ongkir = reverse.match(/\d{1,3}/g);
                    ribuan_ongkir = ribuan_ongkir.join(',').split('').reverse().join('');

                    $("#ongkir").html("Rp." + ribuan_ongkir)
                    // menghitung total ongkir
                    var ongkir = $("option:selected", this).attr("ongkir");


                    var data_total_bayar = parseInt(ongkir) + parseInt(<?= array_sum(array_column($cart, 'subtotal')) ?>);



                    var reverse2 = data_total_bayar.toString().split('').reverse().join(''),
                        ribuan_total_bayar = reverse2.match(/\d{1,3}/g);
                    ribuan_total_bayar = ribuan_total_bayar.join(',').split('').reverse().join('');
                    // alert(data_total_bayar);
                    $("#total_bayar").html("Rp." +
                        ribuan_total_bayar);

                    // estimasi & ongkir
                    var estimasi = $("option:selected", this).attr("estimasi");
                    $("input[name=estimasi]").val(estimasi);
                    $("input[name=ongkir]").val(dataongkir);
                    $("input[name=total_bayar]").val(data_total_bayar);
                });

            });
        </script>
    </div>
    </div>


</main>