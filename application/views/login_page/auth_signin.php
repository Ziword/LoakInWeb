<!doctype html>
<html lang="en" class="no-focus">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Control Panel Aplikasi Loak-In</title>

    <meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="Login Page Sub APP Monev">
    <meta property="og:site_name" content="Monev">
    <meta property="og:description" content="Sub APP Pelaporan Monev">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>assets/images/logo-mini.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>assets/images/favicon.png">
    <!-- END Icons -->

    <!-- Stylesheets -->

    <!-- Fonts and Codebase framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap">
    <link rel="stylesheet" id="css-main" href="<?= base_url(); ?>assets/css/codebase.min.css">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="<?= base_url(); ?>assets/css/themes/flat.min.css"> -->
    <!-- END Stylesheets -->
</head>

<body>
    <!-- Modal Login gagal -->
    <div id="loginFail" class="modal fade">
        <div class="modal-dialog modal-danger">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h4>Login Gagal!</h4>
                    <p>Username atau password salah.</p>
                    <button class="btn btn-success" data-dismiss="modal"><span>CLOSE</span> <i class="material-icons">&#xE5C8;</i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Login Gagal -->

    <!-- Modal Login Needed -->
    <div id="loginNeed" class="modal fade">
        <div class="modal-dialog modal-danger">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <h4>Warning!</h4>
                    <p>Harus login terlebih dahulu.</p>
                    <button class="btn btn-success" data-dismiss="modal"><span>CLOSE</span> <i class="material-icons">&#xE5C8;</i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Login Needed -->

    <div id="page-container" class="main-content-boxed">

        <!-- Main Container -->
        <main id="main-container">

            <!-- Page Content -->
            <div class="bg-body-dark bg-pattern" style="background-image: url('<?= base_url(); ?>assets/media/various/bg-pattern-inverse.png');">
                <div class="row mx-0 justify-content-center">
                    <div class="hero-static col-lg-6 col-xl-4">
                        <div class="content content-full overflow-hidden">
                            <!-- Header -->
                            <div class="py-30 text-center">
                                <a class="link-effect font-w700" href="#">
                                    <span class="font-size-xl text-primary-dark">Control Panel</span><span class="font-size-xl">Aplikasi Loak-In</span>
                                </a>
                                <h1 class="h4 font-w700 mt-30 mb-10">Welcome to Login Page</h1>
                                <h2 class="h5 font-w400 text-muted mb-0">It’s a great day today!</h2>
                            </div>
                            <!-- END Header -->

                            <!-- Sign In Form -->
                            <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-signin" action="<?= base_url(); ?>CLogin/cek" method="post">
                                <div class="block block-themed block-rounded block-shadow">
                                    <div class="block-header bg-gd-dusk">
                                        <h3 class="block-title">Please Sign In</h3>
                                    </div>
                                    <div class="block-content">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="login-email">Username</label>
                                                <input type="text" class="form-control" id="login-username" name="username">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="login-password">Password</label>
                                                <input type="password" class="form-control" id="login-password" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-sm-12 text-sm-right push">
                                                <button type="submit" class="btn btn-alt-primary">
                                                    <i class="si si-login mr-10"></i> Sign In
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-content bg-body-light">
                                        <div class="form-group text-center">
                                            <!-- For response -->
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END Sign In Form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Page Content -->

        </main>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->

    <script src="<?= base_url(); ?>assets/js/codebase.core.min.js"></script>

    <!--
            Codebase JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at <?= base_url(); ?>assets/_es6/main/app.js
        -->
    <script src="<?= base_url(); ?>assets/js/codebase.app.min.js"></script>

    <!-- Page JS Plugins -->
    <script src="<?= base_url(); ?>assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

    <!-- Page JS Code -->
    <script src="<?= base_url(); ?>assets/js/pages/op_auth_signin.min.js"></script>

    <?php if (isset($_SESSION['perluLogin'])) :  ?>
        <script type='text/javascript'>
            $(document).ready(function() {
                $('#loginNeed').modal('show');
            });
        </script>
    <?php endif ?>

    <?php if (isset($_SESSION['loginGagal'])) :  ?>
        <script type='text/javascript'>
            $(document).ready(function() {
                $('#loginFail').modal('show');
            });
        </script>
    <?php endif ?>
</body>

</html>