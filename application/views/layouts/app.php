<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url('assets/images/logo/logo.jpg'); ?>">


    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/navbar-fixed/">


    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/frontend/libs/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/frontend/libs/fontawesome/css/all.min.css'); ?>">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?= base_url('assets/frontend/css/app.css'); ?>">

    <title><?= isset($title) ? $title : 'Shop'; ?></title>
    <style>
        .card>.card-header {
            background-color: #4c1130;
            color: #fff;
        }

        .card>.card-footer {
            background-color: #4c1130;
            color: #fff;
        }

        .card>.card-body>.table>tbody>tr>* {
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <!-- nav -->
    <?php $this->load->view('layouts/_navbar'); ?>
    <!-- end nav -->

    <!-- content -->
    <?php $this->load->view($page); ?>
    <!-- Endcontent -->




    <script src="<?= base_url(); ?>assets/frontend/libs/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/app.js"></script>

</body>

</html>