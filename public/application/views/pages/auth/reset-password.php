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
                                    <h5 class="text-primary">Reset Password !</h5>
                                    <p class="text-muted">Enter the following details to reset password.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form id="loginForm" method="post" action="<?php echo base_url('/reset-password'); ?>">
                                        <input  autocomplete="off"  type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                        <div class="mb-3">
                                            <label for="otp" class="form-label">OTP</label>
                                            <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter otp" autocomplete="">
                                            <div class="invalid-message"><?php echo form_error('otp'); ?></div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5" placeholder="Enter password" id="password" name="password">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                            <div class="invalid-message"><?php echo form_error('password'); ?></div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="confirm_password" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter the password again">
                                            <div class="invalid-message"><?php echo form_error('confirm_password'); ?></div>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Reset</button>
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

    <script src="{{ asset('admin/js/pages/password-addon.init.js') }}"></script>
    <script type="text/javascript">

        // initialize the validation library
        const validation = new JustValidate('#loginForm', {
            errorFieldCssClass: 'is-invalid',
            focusInvalidField: true,
                lockForm: true,
        });
        // apply rules to form fields
        validation
        .addField('#otp', [
            {
            rule: 'required',
            errorMessage: 'OTP is required',
            },
            {
            rule: 'number',
            errorMessage: 'OTP must be a number!',
            },
            {
            rule: 'minLength',
            value: 4,
            },
            {
            rule: 'maxLength',
            value: 4,
            },
        ])
        .addField('#password', [
            {
            rule: 'required',
            errorMessage: 'Password is required',
            }
        ])
        .addField('#confirm_password', [
            {
            rule: 'required',
            errorMessage: 'Confirm Password is required',
            },
            {
                validator: (value, fields) => {
                if (fields['#password'] && fields['#password'].elem) {
                    const repeatPasswordValue = fields['#password'].elem.value;

                    return value === repeatPasswordValue;
                }

                return true;
                },
                errorMessage: 'Password and Confirm Password must be same',
            },
        ])
        .onSuccess((event) => {
            event.target.submit();
        });
    </script>


</body>


</html>