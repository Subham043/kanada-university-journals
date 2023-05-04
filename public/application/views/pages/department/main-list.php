<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover">


<?php $this->load->view('includes/common_head'); ?>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php $this->load->view('includes/user-header'); ?>

        <?php $this->load->view('includes/user-menu'); ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php $this->load->view('includes/breadcrumb'); ?>


                    <div class="row">

                        <!--end col-->
                        <div class="col-lg-12">
                            
                            <div class="card">
                                <div class="card-header border-0 rounded">
                                    <form id="countryForm" method="get">
                                        <div class="row g-2">
                                            <div class="col-xl-3">
                                                <div class="search-box">
                                                    <input type="text" name="search" class="form-control search" placeholder="Search department by their name..." value="<?php echo $this->input->get('search') ?>"> 
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                    </form>
                                    <!--end row-->
                                </div>
                            </div>

                            <?php if (count($data)) { ?>
                                
                                <div class="team-list row grid-view-filter" id="team-member-list">
                                    <?php foreach ($data as $item) { ?>
                                        <div class="col">
                                            <div class="card team-box">
                                                <div class="team-cover"> <img src="<?php echo base_url('assets/admin/images/logo.png'); ?>" alt="" class="img-fluid"> </div>
                                                <div class="card-body p-4">
                                                    <div class="row align-items-center team-row">
                                                        <div class="col-lg-4 col">
                                                            <div class="team-profile-img">
                                                                <div class="avatar-lg"></div>
                                                                <div class="team-content"> <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">
                                                                        <h5 class="fs-16 mb-1"><?php echo $item->name; ?> (<?php echo $item->code; ?>)</h5>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col">
                                                            <div class="text-end"> <a href="<?php echo base_url('department/'.$this->encryption_url->safe_b64encode($item->id).'/journal-articles'); ?>" class="btn btn-light view-btn">View Detail</a> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php echo $links; ?>
                                </div>
                            <?php } else { ?>
                                <?php $this->load->view('includes/no_result'); ?>
                            <?php } ?>

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


</body>


</html>