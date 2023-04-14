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
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="title" class="form-label"><?php echo $page_name; ?> Title</label>
                                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter conference title" value="<?php echo set_value('title'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="edition" class="form-label"><?php echo $page_name; ?> Edition</label>
                                                        <input type="text" class="form-control" id="edition" name="edition" placeholder="Enter book/article edition" value="<?php echo set_value('edition'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="isbn" class="form-label"><?php echo $page_name; ?> ISBN/ISSN</label>
                                                        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Enter conference isbn" value="<?php echo set_value('isbn'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="date" class="form-label">Date of <?php echo $page_name; ?> Publishing</label>
                                                        <input type="date" class="form-control" id="date" name="date" placeholder="Enter date of conference" value="<?php echo set_value('date'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="link" class="form-label"><?php echo $page_name; ?> Web link KUH website</label>
                                                        <input type="text" class="form-control" id="link" name="link" placeholder="Enter book/article website link KUH website" value="<?php echo set_value('link'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="name" class="form-label"><?php echo $page_name; ?> Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter book/article name" value="<?php echo set_value('name'); ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="image" class="form-label"><?php echo $page_name; ?> Book Image</label>
                                                        <input type="file" class="form-control" id="image" name="image" placeholder="Enter conference image">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="abstract" class="form-label"><?php echo $page_name; ?> Abstract</label>
                                                        <input type="file" class="form-control" id="abstract" name="abstract" placeholder="Enter conference abstract">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="article" class="form-label"><?php echo $page_name; ?> Article</label>
                                                        <input type="file" class="form-control" id="article" name="article" placeholder="Enter conference article">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="publisher_id" class="form-label"><?php echo $page_name; ?> Publisher</label>
                                                        <select class="form-control" id="publisher_id" name="publisher_id"></select>
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="keyword_id" class="form-label"><?php echo $page_name; ?> Keyword</label>
                                                        <select class="form-control" id="keyword_id" name="keyword_id"></select>
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="teacher_id" class="form-label"><?php echo $page_name; ?> Teacher</label>
                                                        <select class="form-control" id="teacher_id" name="teacher_id" multiple></select>
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="editor_id" class="form-label"><?php echo $page_name; ?> Editor</label>
                                                        <select class="form-control" id="editor_id" name="editor_id" multiple></select>
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>

                                                
                                                <input  autocomplete="off"  type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                            </div>
                                            <!--end row-->
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="card repeater-teacher">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Additional Teachers From Other University</h4>
                                        <button
                                            type="button"
                                            data-repeater-create
                                            style="background:green;border-color:green;" type="button"
                                            class="btn btn-success add-btn" id="create-btn"><i
                                                class="ri-add-line align-bottom me-1"></i> Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body p-0">
                                        <div class="live-preview" data-repeater-list="group-a">
                                            <div class="row gy-4 p-3" data-repeater-item>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="teacher_name" class="form-label"><?php echo $page_name; ?> Teacher Name</label>
                                                        <input type="text" class="form-control" name="teacher_name[]" placeholder="Enter teacher name">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="teacher_email" class="form-label"><?php echo $page_name; ?> Teacher Email</label>
                                                        <input type="text" class="form-control" name="teacher_email[]" placeholder="Enter teacher email">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="teacher_mobile" class="form-label"><?php echo $page_name; ?> Teacher Mobile</label>
                                                        <input type="text" class="form-control" name="teacher_mobile[]" placeholder="Enter teacher mobile">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>

                                                <div class="col-xxl-2 col-md-2">
                                                    <button
                                                        type="button"
                                                        data-repeater-delete
                                                        class="btn btn-sm btn-danger remove-item-btn"
                                                        style="background:red"
                                                    >Delete</button>
                                                </div>


                                                

                                            </div>
                                            <!--end row-->
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="card repeater-editor">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Additional Editors From Other University</h4>
                                        <button
                                            type="button"
                                            data-repeater-create
                                            style="background:green;border-color:green;" type="button"
                                            class="btn btn-success add-btn" id="create-btn"><i
                                                class="ri-add-line align-bottom me-1"></i> Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body p-0">
                                        <div class="live-preview">
                                            <div class="row gy-4 p-3" data-repeater-list="group-a">
                                                <div class="col-xxl-4 col-md-6" data-repeater-item>
                                                    <div class="form-group mb-3">
                                                        <label for="editor_name" class="form-label"><?php echo $page_name; ?> Editor Name</label>
                                                        <input type="text" class="form-control" name="editor_name[]" placeholder="Enter editor name">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                    <button
                                                        type="button"
                                                        data-repeater-delete
                                                        class="btn btn-sm btn-danger remove-item-btn"
                                                        style="background:red"
                                                    >Delete</button>
                                                </div>

                                            </div>
                                            <!--end row-->
                                        </div>

                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-xxl-12 col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="submitBtn">Create</button>
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
                $('.repeater-teacher').repeater({
                    // options and callbacks here
                    // isFirstItemUndeletable:true,
                    initEmpty:true,
                    show: function () {
                        $(this).slideDown();
                    },
                    hide: function (deleteElement) {
                        if(confirm('Are you sure you want to delete this element?')) {
                            $(this).slideUp(deleteElement);
                        }
                    },
                    ready: function (setIndexes) {
                    }
                });
                
                $('.repeater-editor').repeater({
                    // options and callbacks here
                    // isFirstItemUndeletable:true,
                    initEmpty:true,
                    show: function () {
                        $(this).slideDown();
                    },
                    hide: function (deleteElement) {
                        if(confirm('Are you sure you want to delete this element?')) {
                            $(this).slideUp(deleteElement);
                        }
                    },
                    ready: function (setIndexes) {
                    }
                });

                $('#countryForm').validate({
                    rules: {
                        title: {
                            required: true,
                            minlength: 2,
                        },
                        isbn: {
                            required: true,
                            minlength: 2,
                        },
                        conference: {
                            required: true,
                            minlength: 3,
                            maxlength: 200,
                        },
                        book: {
                            maxlength: 200,
                        },
                        editor: {
                            maxlength: 200,
                        },
                        date: {
                            required: true,
                            dateISO: true
                        },
                        keyword_id: {
                            required: true,
                        },
                        teacher_id: {
                            required: true,
                        },
                        place: {
                            required: true,
                        },
                        link: {
                            required: true,
                            url: true
                        },
                        image: {
                            required: true
                        },
                        article: {
                            required: true
                        },
                        abstract: {
                            required: true
                        },
                    },
                    submitHandler: function(form) {
                        var submitBtn = document.getElementById('submitBtn')
                        submitBtn.innerHTML = spinner
                        submitBtn.disabled = true;
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('conference/store'); ?>",
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
                            }
                        });
                    }
                });
            });
        })(jQuery);

        const teacherChoice = new Choices('#teacher_id', {
            choices: [
                <?php foreach($teacher as $teacher){ ?>
                    {
                        value: '<?php echo $teacher->id; ?>',
                        label: '<?php echo $teacher->first_name; ?> ~ <?php echo $teacher->code; ?>',
                    },
                <?php } ?>
            ],
            placeholderValue: 'Select a teacher',
            ...CHOICE_CONFIG
        });
        
        const editorChoice = new Choices('#editor_id', {
            choices: [
                <?php foreach($editor as $editor){ ?>
                    {
                        value: '<?php echo $editor->id; ?>',
                        label: '<?php echo $editor->first_name; ?> ~ <?php echo $editor->code; ?>',
                    },
                <?php } ?>
            ],
            placeholderValue: 'Select a editor',
            ...CHOICE_CONFIG
        });

        const keywordChoice = new Choices('#keyword_id', {
            choices: [
                {
                    value: '',
                    label: 'Select a keyword',
                    selected: true,
                    disabled: true,
                },
                <?php foreach($keyword as $keyword){ ?>
                    {
                        value: '<?php echo $keyword->id; ?>',
                        label: '<?php echo $keyword->name; ?> ~ <?php echo $keyword->code; ?>',
                    },
                <?php } ?>
            ],
            placeholderValue: 'Select a keyword',
            ...CHOICE_CONFIG
        });
        
        const publisherChoice = new Choices('#publisher_id', {
            choices: [
                {
                    value: '',
                    label: 'Select a publisher',
                    selected: true,
                    disabled: true,
                },
                <?php foreach($publisher as $publisher){ ?>
                    {
                        value: '<?php echo $publisher->id; ?>',
                        label: '<?php echo $publisher->name; ?> ~ <?php echo $publisher->code; ?>',
                    },
                <?php } ?>
            ],
            placeholderValue: 'Select a publisher',
            ...CHOICE_CONFIG
        });

        
    </script>


</body>


</html>