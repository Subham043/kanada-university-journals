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
                                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter book/article title" value="<?php echo $data->title; ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="edition" class="form-label"><?php echo $page_name; ?> Edition</label>
                                                        <input type="text" class="form-control" id="edition" name="edition" placeholder="Enter book/article edition" value="<?php echo $data->edition; ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="isbn" class="form-label"><?php echo $page_name; ?> ISBN/ISSN</label>
                                                        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Enter book/article isbn" value="<?php echo $data->isbn; ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="date" class="form-label">Date of <?php echo $page_name; ?> Publishing</label>
                                                        <input type="date" class="form-control" id="date" name="date" placeholder="Enter publishing date of book/article" value="<?php echo $data->date; ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="link" class="form-label"><?php echo $page_name; ?> Web link KUH website</label>
                                                        <input type="text" class="form-control" id="link" name="link" placeholder="Enter book/article website link KUH website" value="<?php echo $data->link; ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="name" class="form-label"><?php echo $page_name; ?> Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter book/article name" value="<?php echo $data->name; ?>">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="image" class="form-label"><?php echo $page_name; ?> Book Image</label>
                                                        <input type="file" class="form-control" id="image" name="image" placeholder="Enter book/article image">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="abstract" class="form-label"><?php echo $page_name; ?> Abstract</label>
                                                        <input type="file" class="form-control" id="abstract" name="abstract" placeholder="Enter book/article abstract">
                                                        <i class="invalid-message error"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="article" class="form-label"><?php echo $page_name; ?> Article</label>
                                                        <input type="file" class="form-control" id="article" name="article" placeholder="Enter book/article article">
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
                                                        <label for="teacher_id" class="form-label"><?php echo $page_name; ?> Author</label>
                                                        <select class="form-control" id="teacher_id" name="teacher_id[]" multiple></select>
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

                                                <div class="col-lg-12 col-md-12">
                                                    <div class="mt-4 mt-md-0">
                                                        <div class="form-group">
                                                            <div class="form-check form-switch form-check-right mb-2">
                                                                <input class="form-check-input" type="checkbox" role="switch" id="is_published" name="is_published" <?php echo $data->is_published==1 ? 'checked' : ''; ?> >
                                                                <label class="form-check-label" for="is_published">Publish on website ?</label>
                                                            </div>
                                                            <i class="invalid-message error"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="mt-4 mt-md-0">
                                                        <div class="form-group">
                                                            <div class="form-check form-switch form-check-right mb-2">
                                                                <input class="form-check-input" type="checkbox" role="switch" id="is_downloadable" name="is_downloadable" <?php echo $data->is_downloadable==1 ? 'checked' : ''; ?> >
                                                                <label class="form-check-label" for="is_downloadable">Can download without login ?</label>
                                                            </div>
                                                            <i class="invalid-message error"></i>
                                                        </div>
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
                                        <h4 class="card-title mb-0 flex-grow-1">Additional Authors From Other University</h4>
                                        <button
                                            type="button"
                                            data-repeater-create
                                            style="background:green;border-color:green;" type="button"
                                            class="btn btn-success add-btn" id="create-btn"><i
                                                class="ri-add-line align-bottom me-1"></i> Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body p-0">
                                        <div class="live-preview" data-repeater-list="group-a">
                                            <?php if(empty($selected_add_teacher)){ ?>
                                                <div class="row gy-4 p-3" data-repeater-item>
                                                    <div class="col-xxl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="teacher_name" class="form-label"><?php echo $page_name; ?> Teacher Name</label>
                                                            <input type="text" class="form-control teacher_name" name="teacher_name[]" placeholder="Enter teacher name">
                                                            <i class="invalid-message error"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="teacher_email" class="form-label"><?php echo $page_name; ?> Teacher Email</label>
                                                            <input type="text" class="form-control teacher_email" name="teacher_email[]" placeholder="Enter teacher email">
                                                            <i class="invalid-message error"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="teacher_mobile" class="form-label"><?php echo $page_name; ?> Teacher Mobile</label>
                                                            <input type="text" class="form-control teacher_mobile" name="teacher_mobile[]" placeholder="Enter teacher mobile">
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
                                            <?}else{ ?>
                                                <?php foreach($selected_add_teacher as $selected_add_teacher){ ?>
                                                <div class="row gy-4 p-3" data-repeater-item>
                                                    <div class="col-xxl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="teacher_name" class="form-label"><?php echo $page_name; ?> Teacher Name</label>
                                                            <input type="text" class="form-control teacher_name" name="teacher_name[]" placeholder="Enter teacher name" value="<?php echo $selected_add_teacher->teacher_name; ?>">
                                                            <i class="invalid-message error"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="teacher_email" class="form-label"><?php echo $page_name; ?> Teacher Email</label>
                                                            <input type="text" class="form-control teacher_email" name="teacher_email[]" placeholder="Enter teacher email" value="<?php echo $selected_add_teacher->teacher_email; ?>">
                                                            <i class="invalid-message error"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="teacher_mobile" class="form-label"><?php echo $page_name; ?> Teacher Mobile</label>
                                                            <input type="text" class="form-control teacher_mobile" name="teacher_mobile[]" placeholder="Enter teacher mobile" value="<?php echo $selected_add_teacher->teacher_mobile; ?>">
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
                                                <?php } ?>
                                            <?php } ?>

                                                

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
                                                <?php if(empty($selected_add_editor)){ ?>
                                                    <div class="col-xxl-4 col-md-6" data-repeater-item>
                                                        <div class="form-group mb-3">
                                                            <label for="editor_name" class="form-label"><?php echo $page_name; ?> Editor Name</label>
                                                            <input type="text" class="form-control editor_name" name="editor_name[]" placeholder="Enter editor name" value="">
                                                            <i class="invalid-message error"></i>
                                                        </div>
                                                        <button
                                                            type="button"
                                                            data-repeater-delete
                                                            class="btn btn-sm btn-danger remove-item-btn"
                                                            style="background:red"
                                                        >Delete</button>
                                                    </div>
                                                <?php }else{ ?>
                                                    <?php foreach($selected_add_editor as $selected_add_editor){ ?>
                                                    <div class="col-xxl-4 col-md-6" data-repeater-item>
                                                        <div class="form-group mb-3">
                                                            <label for="editor_name" class="form-label"><?php echo $page_name; ?> Editor Name</label>
                                                            <input type="text" class="form-control editor_name" name="editor_name[]" placeholder="Enter editor name" value="<?php echo $selected_add_editor->editor_name; ?>">
                                                            <i class="invalid-message error"></i>
                                                        </div>
                                                        <button
                                                            type="button"
                                                            data-repeater-delete
                                                            class="btn btn-sm btn-danger remove-item-btn"
                                                            style="background:red"
                                                        >Delete</button>
                                                    </div>
                                                    <?php } ?>
                                                <?php } ?>

                                            </div>
                                            <!--end row-->
                                        </div>

                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-xxl-12 col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="submitBtn">Update</button>
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

    <script type="text/javascript" nonce="<?php echo $nonce; ?>">
        (function( $ ) {
            $(document).ready(function() {
                $('.repeater-teacher').repeater({
                    // options and callbacks here
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
                            minlength: 3,
                            maxlength: 200,
                        },
                        edition: {
                            required: true,
                            minlength: 3,
                            maxlength: 200,
                        },
                        isbn: {
                            required: true,
                            minlength: 3,
                            maxlength: 200,
                        },
                        name: {
                            required: true,
                            minlength: 3,
                            maxlength: 200,
                        },
                        date: {
                            required: true,
                            dateISO: true
                        },
                        keyword_id: {
                            required: true,
                        },
                        publisher_id: {
                            required: true,
                        },
                        link: {
                            required: true,
                            url: true
                        },
                    },
                    submitHandler: function(form) {
                        var submitBtn = document.getElementById('submitBtn')
                        submitBtn.innerHTML = spinner
                        submitBtn.disabled = true;

                        const formData = new FormData;
                        formData.append('is_published',document.getElementById('is_published').checked ? 1 : 0)
                        formData.append('is_downloadable',document.getElementById('is_downloadable').checked ? 1 : 0)
                        formData.append('title', document.getElementById('title').value)
                        formData.append('edition', document.getElementById('edition').value)
                        formData.append('isbn', document.getElementById('isbn').value)
                        formData.append('date', document.getElementById('date').value)
                        formData.append('link', document.getElementById('link').value)
                        formData.append('name', document.getElementById('name').value)
                        formData.append('publisher_id', document.getElementById('publisher_id').value)
                        formData.append('keyword_id', document.getElementById('keyword_id').value)
                        if((document.getElementById('image').files).length>0){
                            formData.append('image',document.getElementById('image').files[0])
                        }
                        if((document.getElementById('abstract').files).length>0){
                            formData.append('abstract',document.getElementById('abstract').files[0])
                        }
                        if((document.getElementById('article').files).length>0){
                            formData.append('article',document.getElementById('article').files[0])
                        }
                        if(document.getElementById('teacher_id')?.length>0){
                            for (let index = 0; index < document.getElementById('teacher_id').length; index++) {
                                formData.append('teacher_id[]',document.getElementById('teacher_id')[index].value)
                            }
                        }
                        if(document.getElementById('editor_id')?.length>0){
                            for (let index = 0; index < document.getElementById('editor_id').length; index++) {
                                formData.append('editor_id[]',document.getElementById('editor_id')[index].value)
                            }
                        }

                        const teacher_name = document.querySelectorAll('.teacher_name');
                        for (let index = 0; index < teacher_name.length; index++) {
                            if(teacher_name[index].value){
                                formData.append('teacher_name[]',teacher_name[index].value)
                            }
                        }
                        
                        const teacher_email = document.querySelectorAll('.teacher_email');
                        for (let index = 0; index < teacher_email.length; index++) {
                            if(teacher_email[index].value){
                                formData.append('teacher_email[]',teacher_email[index].value)
                            }
                        }
                        
                        const teacher_mobile = document.querySelectorAll('.teacher_mobile');
                        for (let index = 0; index < teacher_mobile.length; index++) {
                            if(teacher_mobile[index].value){
                                formData.append('teacher_mobile[]',teacher_mobile[index].value)
                            }
                        }
                        
                        const editor_name = document.querySelectorAll('.editor_name');
                        for (let index = 0; index < editor_name.length; index++) {
                            if(editor_name[index].value){
                                formData.append('editor_name[]',editor_name[index].value)
                            }
                        }

                        formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").val())
                        
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('admin/book-article/update/'.$id); ?>",
                            data: formData,
                            processData: false,
                            contentType: false,
                            cache: false,
                            async: true,
                            dataType: "json",
                            success: function(response) {
                                successToast(response?.message)
                                submitBtn.innerHTML =  `
                                    Update
                                    `
                                submitBtn.disabled = false;
                                if (response.hasOwnProperty('<?php echo $this->security->get_csrf_token_name(); ?>')) {
                                    $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").val(response['<?php echo $this->security->get_csrf_token_name(); ?>']);
                                }
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                errorToast(xhr?.responseJSON?.message)
                                $.each(xhr?.responseJSON?.error, function(key, value) {
                                    if(key=='editor_name[]' || key=='teacher_name[]' || key=='teacher_email[]' || key=='teacher_mobile[]'){
                                        $('.' + key.replace("[]", "")).parents('.form-group').find('.error').html(value);
                                    }else{
                                        $('#' + key.replace("[]", "")).parents('.form-group').find('.error').html(value);
                                    }
                                });
                                submitBtn.innerHTML =  `
                                    Update
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

        const teacherChoice = new Choices('#teacher_id', {
            choices: [
                <?php foreach($teacher as $teacher){ ?>
                    {
                        value: '<?php echo $teacher->id; ?>',
                        label: '<?php echo $teacher->first_name; ?> ~ <?php echo $teacher->code; ?>',
                        selected: <?php echo (in_array($teacher->id, $selected_teacher)) ? 'true' : 'false'; ?>,
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
                        selected: <?php echo (in_array($editor->id, $selected_editor)) ? 'true' : 'false'; ?>,
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
                    selected: false,
                    disabled: true,
                },
                <?php foreach($keyword as $keyword){ ?>
                    {
                        value: '<?php echo $keyword->id; ?>',
                        label: '<?php echo $keyword->name; ?> ~ <?php echo $keyword->code; ?>',
                        selected: <?php echo $data->keyword_id==$keyword->id ? 'true' : 'false'; ?>,
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
                        selected: <?php echo $data->publisher_id==$publisher->id ? 'true' : 'false'; ?>,
                    },
                <?php } ?>
            ],
            placeholderValue: 'Select a publisher',
            ...CHOICE_CONFIG
        });

        
    </script>


</body>


</html>