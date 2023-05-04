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
                                <div class="card-header rounded">
                                    <form id="countryForm" method="get">
                                        <div class="row g-2 align-items-center">
                                            <div class="col-lg-auto">
                                                <h4 class="card-title mb-0"><?php echo $page_name; ?></h4>
                                            </div>
                                            <!--end col-->
                                            <div class="col-xxl-3 ms-auto">
                                            </div>
                                            <!--end col-->
                                            <div class="col-xl-5">
                                                <div class="search-box">
                                                    <input type="text" name="search" class="form-control search" placeholder="Search Book Articles..." value="<?php echo $this->input->get('search') ?>"> 
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                    </form>
                                    <!--end row-->
                                </div>
                            </div>

                            <div>
                                <div class="row">
                                    <div class="col-12 px-4">
                                        <?php if (count($data)) { ?>
                                        
                                            <div class="team-list row grid-view-filter" id="team-member-list">
                                                <ol class="mb-0 sub-menu ps-3 vstack gap-2 mb-2 list-style-none">
                                                    <?php $i=1; foreach ($data as $item) { ?>
                                                        <li class="mb-2"><p class="font-12"><?php echo $i; $i++; ?>. <?php echo $item->first_last_name; ?>, <?php echo date('Y', strtotime($item->date)); ?>, <?php echo $item->title; ?>, <a href="<?php echo $item->link; ?>" target="_blank"><?php echo $item->name; ?></a> (<?php echo $item->edition; ?>), <?php echo $item->publisher_name; ?>, <?php echo $item->isbn; ?></p></li>
                                                    <?php } ?>
                                                </ol>
                                                <?php echo $links; ?>
                                            </div>
                                        <?php } else { ?>
                                            <?php $this->load->view('includes/no_result'); ?>
                                        <?php } ?>
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
    <script src="<?php echo base_url('assets/admin/js/pages/choices.min.js'); ?>"></script>

</body>


</html>