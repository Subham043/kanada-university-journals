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
                                    <h5 class="text-primary">Forgot Password?</h5>
                                    <p class="text-muted">Reset password with KANNADA UNIVERSITY</p>

                                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl">
                                    </lord-icon>

                                </div>

                                <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                                    Enter your email and instructions will be sent to you!
                                </div>
                                <div class="p-2">
                                    <form id="forgotPasswordForm" method="post" action="<?php echo base_url('/forgot-password'); ?>">

                                        <div class="mb-4">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                                            <div class="invalid-message"><?php echo form_error('email'); ?></div>
                                        </div>
                                        <input  autocomplete="off"  type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                        <div class="text-center mt-4">
                                            <button class="btn btn-success w-100" type="submit">Send Reset Link</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Wait, I remember my password... <a href="<?php echo base_url('/login'); ?>" class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
                        </div>

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

    <script type="text/javascript">

        // initialize the validation library
        const validation = new JustValidate('#forgotPasswordForm', {
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
        .onSuccess((event) => {
            event.target.submit();
        });
    </script>

</body>


</html>