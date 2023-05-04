<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover">


<?php $this->load->view('includes/common_head'); ?>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">



        <?php ($this->session->userdata('admin_id') == '' || $this->session->userdata('user_type') == 2) ? $this->load->view('includes/user-header') : $this->load->view('includes/header'); ?>

        <?php ($this->session->userdata('admin_id') == '' || $this->session->userdata('user_type') == 2) ? $this->load->view('includes/user-menu') : $this->load->view('includes/menu'); ?>

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
                    <div class="row project-wrapper">
                        <div class="col-xxl-12">
                            <div class="card-body p-0">
                                <div class="p-3">
                                    <div class="row">
                                        
                                        <div class="col-xl-3">
                                            <div class="card card-animate no-box-shadow">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-success text-success rounded-2 fs-2">
                                                                <i class="ri-contacts-book-2-line text-success"></i>
                                                            </span>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <div class="d-flex align-items-center">
                                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="text-uppercase">Books</span></h4>
                                                            </div>
                                                            <p class="text-muted mb-0">
                                                                <?php echo $book; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-3">
                                            <div class="card card-animate no-box-shadow">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-success text-success rounded-2 fs-2">
                                                                <i class="ri-article-fill text-success"></i>
                                                            </span>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <div class="d-flex align-items-center">
                                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="text-uppercase">Book Articles</span></h4>
                                                            </div>
                                                            <p class="text-muted mb-0">
                                                                <?php echo $book_article; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-3">
                                            <div class="card card-animate no-box-shadow">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-success text-success rounded-2 fs-2">
                                                                <i class="ri-newspaper-line text-success"></i>
                                                            </span>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <div class="d-flex align-items-center">
                                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="text-uppercase">Journals</span></h4>
                                                            </div>
                                                            <p class="text-muted mb-0">
                                                                <?php echo $journal; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-3">
                                            <div class="card card-animate no-box-shadow">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-success text-success rounded-2 fs-2">
                                                                <i class="ri-article-fill text-success"></i>
                                                            </span>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <div class="d-flex align-items-center">
                                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="text-uppercase">Journal Articles</span></h4>
                                                            </div>
                                                            <p class="text-muted mb-0">
                                                                <?php echo $journal_article; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-4">
                                            <div class="card card-animate no-box-shadow">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-success text-success rounded-2 fs-2">
                                                                <i class="ri-account-pin-box-fill text-success"></i>
                                                            </span>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <div class="d-flex align-items-center">
                                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="text-uppercase">Conferences</span></h4>
                                                            </div>
                                                            <p class="text-muted mb-0">
                                                                <?php echo $conference; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="card card-animate no-box-shadow">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-success text-success rounded-2 fs-2">
                                                                <i class="ri-user-star-fill text-success"></i>
                                                            </span>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <div class="d-flex align-items-center">
                                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="text-uppercase">Teachers</span></h4>
                                                            </div>
                                                            <p class="text-muted mb-0">
                                                                <?php echo $teacher; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-4">
                                            <div class="card card-animate no-box-shadow">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-success text-success rounded-2 fs-2">
                                                                <i class="ri-file-user-line text-success"></i>
                                                            </span>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <div class="d-flex align-items-center">
                                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="text-uppercase">Departments</span></h4>
                                                            </div>
                                                            <p class="text-muted mb-0">
                                                                <?php echo $department; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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


</body>


</html>