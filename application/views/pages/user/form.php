<main role="main" class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <span>Form User</span>

                </div>
                <div class="card-body">
                    <?= form_open_multipart($form_action, ['method' => 'POST']); ?>
                    <?= isset($input->id) ? form_hidden('id', $input->id) : ''; ?>
                    <div class="form-group">
                        <label>Username</label>
                        <?= form_input('name', $input->name, ['class' => 'form-control p_input', 'placeholder' => 'Masukan Username anda!']); ?>
                        <?= form_error('name'); ?>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <?= form_input(['type' => 'email', 'name' => 'email', 'value' => $input->email, 'class' => 'form-control p_input', 'placeholder' => 'Masukan alamat email!']); ?>
                        <?= form_error('email'); ?>
                    </div>
                    <div class="form-group row">
                        <label>Password</label>
                        <?= form_password('password', '', ['class' => 'form-control p_input', 'placeholder' => 'Password minimal 8 karakter!']); ?>
                        <?= form_error('password'); ?>
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <?= form_radio(['name' => 'role', 'value' => 'admin', 'checked' => $input->role == 'admin' ? true : false, 'class' => 'form-check-input']); ?>
                            <label for="" class="form-check-label">Admin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <?= form_radio(['name' => 'role', 'value' => 'member', 'checked' => $input->role == 'member' ? true : false, 'class' => 'form-check-input']); ?>
                            <label for="" class="form-check-label">Member</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Status User</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <?= form_radio(['name' => 'is_active', 'value' => '1', 'checked' => $input->is_active == '1' ? true : false, 'class' => 'form-check-input']); ?>
                            <label for="" class="form-check-label">Aktif</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <?= form_radio(['name' => 'is_active', 'value' => '0', 'checked' => $input->is_active == '0' ? true : false, 'class' => 'form-check-input']); ?>
                            <label for="" class="form-check-label">Tidak aktif</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Foto</label>
                        <br>
                        <?= form_upload('image'); ?>
                        <?php if ($this->session->flashdata('image_error')) : ?>
                            <small class="text-form text-danger"><?= $this->session->flashdata('image_error'); ?></small>
                        <?php endif; ?>

                        <?php if (isset($input->image)) : ?>
                            <img src="<?= base_url("assets/images/user/$input->image"); ?>" alt="" height="150px">
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <?= form_close(); ?>

                </div>
            </div>

        </div>
    </div>


</main>