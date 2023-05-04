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


                    <div class="row pb-5">

                        <!--end col-->
                        <div class="col-lg-12">
                            
                            <div class="profile-foreground position-relative mx-n4 mt-n4 h-100">
                                <div class="profile-wid-bg">
                                    <img src="<?php echo base_url('assets/admin/images/logo.png'); ?>" alt="" class="profile-wid-img" style="object-position: right;">
                                </div>
                            </div>
                            <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper h-100">
                                <div class="row g-4">
                                    <!--end col-->
                                    <div class="col">
                                        <div class="p-2">
                                            <h3 class="text-dark mb-1"><?php echo $data->name; ?> (<?php echo $data->code; ?>)</h3>
                                        </div>
                                    </div>
                                    <!--end col-->

                                </div>
                                <!--end row-->
                            </div>

                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                    <div class="row mt-5 pt-5">

                        <!--end col-->
                        <div class="col-xxl-12 mt-5">
                            <div class="card ">
                                <div class="card-header">
                                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0">
                                        <li class="nav-item">
                                            <a class="nav-link " href="<?php echo base_url('department/'.$this->encryption_url->safe_b64encode($data->id).'/journal-articles'); ?>">
                                                <i class="fas fa-home"></i>
                                                Journal Articles (<?php echo $journal_articles_count; ?>)
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo base_url('department/'.$this->encryption_url->safe_b64encode($data->id).'/book-articles'); ?>">
                                                <i class="far fa-user"></i>
                                                Book Articles (<?php echo $book_articles_count; ?>)
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo base_url('department/'.$this->encryption_url->safe_b64encode($data->id).'/journal'); ?>">
                                                <i class="far fa-user"></i>
                                                Journals (<?php echo $journal_count; ?>)
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" href="<?php echo base_url('department/'.$this->encryption_url->safe_b64encode($data->id).'/book'); ?>">
                                                <i class="far fa-user"></i>
                                                Books (<?php echo $book_count; ?>)
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo base_url('department/'.$this->encryption_url->safe_b64encode($data->id).'/conference-proceedings'); ?>">
                                                <i class="far fa-user"></i>
                                                Conference Proceedings (<?php echo $conference_count; ?>)
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails">
                                            <?php if (count($conference)) { ?>
                                        
                                                <div class="team-list row grid-view-filter" id="team-member-list">
                                                    <ol class="mb-0 sub-menu ps-3 vstack gap-2 mb-2">
                                                        <?php foreach ($conference as $item) { ?>
                                                            <li class="mb-2"><p class="font-12"><?php echo $item->first_last_name; ?>, <?php echo date('Y', strtotime($item->date)); ?>, <?php echo $item->title; ?>, <a href="<?php echo $item->link; ?>" target="_blank"><?php echo $item->name; ?></a> (<?php echo $item->edition; ?>), <?php echo $item->publisher_name; ?>, <?php echo $item->isbn; ?></p></li>
                                                        <?php } ?>
                                                    </ol>
                                                    <?php echo $links; ?>
                                                </div>
                                            <?php } else { ?>
                                                <?php $this->load->view('includes/no_result'); ?>
                                            <?php } ?>
                                        </div>
                                        <!--end tab-pane-->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
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