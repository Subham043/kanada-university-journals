<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover">

<head>
    <?php $this->load->view('includes/common_head'); ?>
</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <?php $this->load->view('includes/auth_banner'); ?>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="<?php echo base_url('/login'); ?>" class="d-inline-block auth-logo">
                                    <img src="<?php echo base_url('assets/admin/images/logo.png'); ?>" style="height: 200px; object-fit: contain;" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to SNN RAJ CORP Admin Panel.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form id="loginForm" method="post" action="<?php echo base_url('/login'); ?>">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                            <div class="invalid-message"><?php echo form_error('email'); ?></div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="<?php echo base_url('forgot-password'); ?>" class="text-muted">Forgot password?</a>
                                            </div>
                                            <label class="form-label" for="password">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5" placeholder="Enter password" id="password" name="password">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                            <div class="invalid-message"><?php echo form_error('password'); ?></div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>

                                        <input  autocomplete="off"  type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Sign In</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                    </div>
                </div>

                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->


    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <?php $this->load->view('includes/common_script'); ?>

    <script src="<?php echo base_url('assets/admin/js/pages/password-addon.init.js'); ?>"></script>
    <script type="text/javascript" nonce="<?php echo $nonce; ?>">

        // initialize the validation library
        const validation = new JustValidate('#loginForm', {
            errorFieldCssClass: 'is-invalid',
            focusInvalidField: true,
            lockForm: true,
        });
        // apply rules to form fields
        validation
        .addField('#email', [
            {
            rule: 'required',
            errorMessage: 'Email is required',
            },
            {
            rule: 'email',
            errorMessage: 'Email is invalid!',
            },
        ])
        .addField('#password', [
            {
            rule: 'required',
            errorMessage: 'Password is required',
            }
        ])
        .onSuccess((event) => {
            event.target.submit();
        });
    </script>
    
</body>


</html>