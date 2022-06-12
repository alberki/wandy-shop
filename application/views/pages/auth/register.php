<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title; ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/auth/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/auth/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/auth/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo/logo.jpg" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <?php $this->load->view('layouts/_alert'); ?>
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Register</h3>
                            <?= form_open('register', ['method' => 'POST']); ?>
                            <div class="form-group">
                                <label>Username</label>
                                <?= form_input('name', $input->name, ['class' => 'form-control p_input', 'placeholder' => 'Masukan Username anda!', 'required' => true]); ?>
                                <?= form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <?= form_input(['type' => 'email', 'name' => 'email', 'value' => $input->email, 'class' => 'form-control p_input', 'placeholder' => 'Masukan alamat email!', 'required' => true]); ?>
                                <?= form_error('email'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <?= form_password('password', '', ['class' => 'form-control p_input', 'placeholder' => 'Password minimal 8 karakter!', 'required' => true]); ?>
                                    <?= form_error('password'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label>Konfirmasi Password</label>
                                    <?= form_password('password_confirmation', '', ['class' => 'form-control p_input', 'placeholder' => 'Konfirmasi Password!', 'required' => true]); ?>
                                    <?= form_error('password_confirmation'); ?>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block enter-btn">register</button>
                            </div>
                            <p class="sign-up text-center">Already have an Account?<a href="<?= base_url('login'); ?>"> Login</a></p>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url(); ?>assets/auth/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url(); ?>assets/auth/js/off-canvas.js"></script>
    <script src="<?= base_url(); ?>assets/auth/js/hoverable-collapse.js"></script>
    <script src="<?= base_url(); ?>assets/auth/js/misc.js"></script>
    <script src="<?= base_url(); ?>assets/auth/js/settings.js"></script>
    <script src="<?= base_url(); ?>assets/auth/js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>