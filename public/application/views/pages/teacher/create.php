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

                    <?php $this->load->view('includes/breadcrumb'); ?>


                    <div class="row mt-5">

                        <!--end col-->
                        <div class="col-lg-12">
                            <form id="countryForm" method="post" enctype="multipart/form-data">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1"><?php echo $page_name; ?></h4>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row gy-4">
                                                <div class="col-xxl-3 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="code" class="form-label"><?php echo $page_name; ?> Code</label>
                                                        <input type="text" class="form-control" id="code" name="code" placeholder="Enter teacher code" value="<?php echo set_value('code'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="prefix" class="form-label"><?php echo $page_name; ?> Prefix</label>
                                                        <select class="form-control" id="prefix" name="prefix"></select>
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="first_name" class="form-label"><?php echo $page_name; ?> First Name</label>
                                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter teacher first name" value="<?php echo set_value('first_name'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="last_name" class="form-label"><?php echo $page_name; ?> Last Name</label>
                                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter teacher last name" value="<?php echo set_value('last_name'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="dob" class="form-label"><?php echo $page_name; ?> Date Of Birth</label>
                                                        <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter teacher date of birth" value="<?php echo set_value('dob'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="joining" class="form-label"><?php echo $page_name; ?> Date Of Joining</label>
                                                        <input type="date" class="form-control" id="joining" name="joining" placeholder="Enter teacher date of birth" value="<?php echo set_value('joining'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="email" class="form-label"><?php echo $page_name; ?> Email</label>
                                                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter teacher email" value="<?php echo set_value('email'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="mobile" class="form-label"><?php echo $page_name; ?> Mobile</label>
                                                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter teacher mobile" value="<?php echo set_value('mobile'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="subject" class="form-label"><?php echo $page_name; ?> Subject and Specialization</label>
                                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter teacher subject & specialization" value="<?php echo set_value('subject'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="link" class="form-label"><?php echo $page_name; ?> Web link KUH website</label>
                                                        <input type="text" class="form-control" id="link" name="link" placeholder="Enter teacher website link KUH website" value="<?php echo set_value('link'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="image" class="form-label"><?php echo $page_name; ?> Image</label>
                                                        <input type="file" class="form-control" id="image" name="image" placeholder="Enter teacher image">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="designation_id" class="form-label"><?php echo $page_name; ?> Designation code</label>
                                                        <select class="form-control" id="designation_id" name="designation_id"></select>
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="department_id" class="form-label"><?php echo $page_name; ?> Department code</label>
                                                        <select class="form-control" id="department_id" name="department_id"></select>
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xxl-12 col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="address" class="form-label"><?php echo $page_name; ?> Address</label>
                                                        <textarea name="address" class="form-control" id="address" placeholder="Enter teacher address" rows="5"><?php echo set_value('address'); ?></textarea>
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <input  autocomplete="off"  type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                <!--end col-->
                                                <div class="col-xxl-12 col-md-12">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="submitBtn">Create</button>
                                                </div>

                                            </div>
                                            <!--end row-->
                                        </div>

                                    </div>
                                </div>
                            </form>
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
    <script src="<?php echo base_url('assets/admin/js/pages/choices.min.js'); ?>"></script>

    <script type="text/javascript">
        (function( $ ) {
            $(document).ready(function() {
                $('#countryForm').validate({
                    rules: {
                        code: {
                            required: true,
                            minlength: 2,
                        },
                        prefix: {
                            required: true,
                        },
                        first_name: {
                            required: true,
                            minlength: 3,
                            maxlength: 200,
                        },
                        last_name: {
                            required: true,
                            maxlength: 200,
                        },
                        dob: {
                            required: true,
                            dateISO: true
                        },
                        joining: {
                            required: true,
                            dateISO: true
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        mobile: {
                            required: true,
                            digits: true,
                            minlength: 10,
                            maxlength: 10,
                        },
                        designation_id: {
                            required: true,
                        },
                        department_id: {
                            required: true,
                        },
                        address: {
                            required: true,
                        },
                        subject: {
                            required: true,
                        },
                        link: {
                            required: true,
                            url: true
                        },
                        image: {
                            required: true
                        },
                    },
                    submitHandler: function(form) {
                        var submitBtn = document.getElementById('submitBtn')
                        submitBtn.innerHTML = spinner
                        submitBtn.disabled = true;
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('admin/teacher/store'); ?>",
                            data: new FormData(form),
                            processData: false,
                            contentType: false,
                            cache: false,
                            async: true,
                            dataType: "json",
                            success: function(response) {
                                successToast(response?.message)
                                form.reset()
                                submitBtn.innerHTML =  `
                                    Create
                                    `
                                submitBtn.disabled = false;
                                if (response.hasOwnProperty('<?php echo $this->security->get_csrf_token_name(); ?>')) {
                                    $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").val(response['<?php echo $this->security->get_csrf_token_name(); ?>']);
                                }
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                errorToast(xhr?.responseJSON?.message)
                                $.each(xhr?.responseJSON?.error, function(key, value) {
                                    $('#' + key).parents('.form-group').find('.error').html(value);
                                });
                                submitBtn.innerHTML =  `
                                    Create
                                    `
                                submitBtn.disabled = false;
                                if (xhr?.responseJSON?.hasOwnProperty('<?php echo $this->security->get_csrf_token_name(); ?>')) {
                                    $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").val(xhr?.responseJSON['<?php echo $this->security->get_csrf_token_name(); ?>']);
                                }
                            }
                        });
                    }
                });
            });
        })(jQuery);

        const prefixChoice = new Choices('#prefix', {
            choices: [
                {
                    value: '',
                    label: 'Select a prefix',
                    selected: true,
                    disabled: true,
                },
                {
                    value: 'Dr',
                    label: 'Dr',
                },
                {
                    value: 'Prof',
                    label: 'Prof',
                },
                {
                    value: 'Sri',
                    label: 'Sri',
                },
                {
                    value: 'Smt',
                    label: 'Smt',
                },
                {
                    value: 'Ms',
                    label: 'Ms',
                },
                {
                    value: 'Mrs',
                    label: 'Mrs',
                },
                {
                    value: 'Mr',
                    label: 'Mr',
                },
                
            ],
            placeholderValue: 'Select a prefix',
            ...CHOICE_CONFIG
        });
        const departmentChoice = new Choices('#department_id', {
            choices: [
                {
                    value: '',
                    label: 'Select a department',
                    selected: true,
                    disabled: true,
                },
                <?php foreach($department as $department){ ?>
                    {
                        value: '<?php echo $department->id; ?>',
                        label: '<?php echo $department->name; ?> ~ <?php echo $department->code; ?>',
                    },
                <?php } ?>
            ],
            placeholderValue: 'Select a department',
            ...CHOICE_CONFIG
        });
        const designationChoice = new Choices('#designation_id', {
            choices: [
                {
                    value: '',
                    label: 'Select a designation',
                    selected: true,
                    disabled: true,
                },
                <?php foreach($designation as $designation){ ?>
                    {
                        value: '<?php echo $designation->id; ?>',
                        label: '<?php echo $designation->name; ?> ~ <?php echo $designation->code; ?>',
                    },
                <?php } ?>
            ],
            placeholderValue: 'Select a designation',
            ...CHOICE_CONFIG
        });

        
    </script>


</body>


</html>