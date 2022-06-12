<main role="main" class="container">
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    Setting Website
                </div>

                <div class="card-body">
                    <form action="<?= base_url('setting/edit'); ?>" method="post">
                        <input type="hidden" name="id" value="<?= $content->id; ?>">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="provinsi">Provinsi</label>
                                <select name="provinsi" id="provinsi" class="form-control">
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="kota">Kabupaten /Kota</label>
                                <select name="kota" id="kota" class="form-control">
                                    <option value="<?= $content->lokasi; ?>"><?= $content->lokasi; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="nama_toko">Nama Toko</label>
                                <input type="text" name="nama_toko" class="form-control" id="nama_toko" aria-describedby="nama_toko" value="<?= $content->nama_toko; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="alamat">Alamat Toko</label>
                                <input type="text" name="alamat" value="<?= $content->alamat; ?>" class="form-control" id="alamat" aria-describedby="alamat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="no_hp">No HP</label>
                                <input type="text" name="no_hp" value="<?= $content->no_hp; ?>" class="form-control" id="no_hp" aria-describedby="no_hp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>