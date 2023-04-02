<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover">


<?php $this->load->view('includes/common_head'); ?>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php $this->load->view('includes/header'); ?>

        <?php $this->load->view('includes/menu'); ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="position-relative mx-n4 mt-n4">
                        <div class="profile-wid-bg profile-setting-img">
                            <img src="<?php echo base_url('assets/admin/images/logo.png'); ?>" class="profile-wid-img" alt="">
                        </div>
                    </div>

                    <div class="row mt-5">

                        <!--end col-->
                        <div class="col-xxl-12 mt-5">
                            <div class="card mt-xxl-n5">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link <?php if ($this->session->flashdata('tab')=='profile') { ?>active<?php } ?>" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                                <i class="fas fa-home"></i>
                                                Personal Details
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if ($this->session->flashdata('tab')=='password') { ?>active<?php } ?>" data-bs-toggle="tab" href="#changePassword" role="tab">
                                                <i class="far fa-user"></i>
                                                Change Password
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane <?php if ($this->session->flashdata('tab')=='profile') { ?>active<?php } ?>" id="personalDetails" role="tabpanel">
                                            <form action="<?php echo base_url('profile-change'); ?>" method="POST" id="profileForm">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" value="<?php echo $admin->name; ?>">
                                                            <div class="invalid-message"><?php echo form_error('name'); ?></div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="phone" class="form-label">Phone
                                                                Number</label>
                                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" value="<?php echo $admin->phone; ?>">
                                                            <div class="invalid-message"><?php echo form_error('phone'); ?></div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email
                                                                Address</label>
                                                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" value="<?php echo $admin->email; ?>">
                                                            <div class="invalid-message"><?php echo form_error('email'); ?></div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <input  autocomplete="off"  type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" class="btn btn-primary" id="submitBtn">Update</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                        <!--end tab-pane-->
                                        <div class="tab-pane <?php if ($this->session->flashdata('tab')=='password') { ?>active<?php } ?>" id="changePassword" role="tabpanel">
                                            <form action="<?php echo base_url('password-change'); ?>" method="POST" id="passwordForm">
                                                <div class="row g-2">
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="crpassword" class="form-label">Current
                                                                Password*</label>
                                                            <input type="password" class="form-control" name="crpassword" id="crpassword" placeholder="Enter current password">
                                                            <div class="invalid-message"><?php echo form_error('crpassword'); ?></div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="password" class="form-label">New
                                                                Password*</label>
                                                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter new password">
                                                            <div class="invalid-message"><?php echo form_error('password'); ?></div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="cnpassword" class="form-label">Confirm
                                                                Password*</label>
                                                            <input type="password" class="form-control" name="cnpassword" id="cnpassword" placeholder="Confirm password">
                                                            <div class="invalid-message"><?php echo form_error('cnpassword'); ?></div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <input  autocomplete="off"  type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                    <div class="col-lg-12 mt-3">
                                                        <div class="text-end">
                                                            <button type="submit" class="btn btn-success" id="submitBtn2">Change
                                                                Password</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>

                                        </div>
                                        <!--end tab-pane-->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div>
                <!-- container-fluid -->
            </div><!-- End Page-content -->

            <?php $this->load->view('includes/footer'); ?>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!-- JAVASCRIPT -->
    <?php $this->load->view('includes/common_script'); ?>

    <!-- App js -->
    <script src="<?php echo base_url('assets/admin/js/main.js'); ?>"></script>

    <script type="text/javascript">
        // initialize the validation library
        const validation = new JustValidate('#profileForm', {
            errorFieldCssClass: 'is-invalid',
            focusInvalidField: true,
            lockForm: true,
        });
        // apply rules to form fields
        validation
            .addField('#name', [{
                    rule: 'required',
                    errorMessage: 'Name is required',
                },
                {
                    rule: 'customRegexp',
                    value: /^[a-zA-Z\s]*$/,
                    errorMessage: 'Name is invalid',
                },
            ])
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
            .addField('#phone', [
                {
                rule: 'required',
                errorMessage: 'Phone is required',
                },
                {
                    rule: 'customRegexp',
                    value: /^[0-9]*$/,
                    errorMessage: 'Phone is invalid',
                },
            ])
            .onSuccess((event) => {
                event.target.submit();
            })

        // initialize the validation library
        const validationPassword = new JustValidate('#passwordForm', {
            errorFieldCssClass: 'is-invalid',
            focusInvalidField: true,
            lockForm: true,
        });
        // apply rules to form fields
        validationPassword
            .addField('#password', [{
                rule: 'required',
                errorMessage: 'Password is required',
            }])
            .addField('#cnpassword', [{
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
            .addField('#crpassword', [{
                rule: 'required',
                errorMessage: 'Current Password is required',
            }])
            .onSuccess((event) => {
                event.target.submit();
            })
    </script>


</body>


</html>