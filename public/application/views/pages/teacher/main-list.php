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
                                                    <input type="text" name="search" class="form-control search" placeholder="Search teacher or department by their name..." value="<?php echo $this->input->get('search') ?>"> 
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-xxl-3 ms-auto">
                                                <div>
                                                    <select class="form-control" id="department_id" name="department"></select>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-auto">
                                                <div class="hstack gap-2">
                                                    <button type="submit" class="btn btn-danger"><i class="ri-equalizer-fill me-1 align-bottom"></i> Filter</button>
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
                                                                <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0"><img src="<?php echo base_url('assets/teacher/'.$item->image); ?>" alt="" class="member-img img-fluid d-block rounded-circle w-100 h-100"></div>
                                                                <div class="team-content"> <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">
                                                                        <h5 class="fs-16 mb-1"><?php echo $item->prefix; ?>. <?php echo $item->first_name; ?> <?php echo $item->last_name; ?></h5>
                                                                    </a>
                                                                    <p class="text-muted member-designation mb-0"><?php echo $item->name; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col">
                                                            <div class="text-end"> <a href="<?php echo base_url('teacher/'.$this->encryption_url->safe_b64encode($item->id).'/journal-articles'); ?>" class="btn btn-light view-btn">View Profile</a> </div>
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
    <script src="<?php echo base_url('assets/admin/js/pages/choices.min.js'); ?>"></script>

    <script type="text/javascript" nonce="<?php echo $nonce; ?>">
        const departmentChoice = new Choices('#department_id', {
            choices: [
                {
                    value: '',
                    label: 'Select a department',
                    <?php if(empty($this->input->get('department'))){ ?>
                        selected: true,
                        disabled: true,
                    <?php } ?>
                },
                <?php foreach($department as $department){ ?>
                    {
                        value: '<?php echo $department->code; ?>',
                        label: '<?php echo $department->name; ?> ~ <?php echo $department->code; ?>',
                        <?php if(!empty($this->input->get('department'))){ ?>
                            selected: <?php echo $department->code == $this->input->get('department') ? 'true' : 'false'; ?>,
                        <?php } ?>
                    },
                <?php } ?>
            ],
            placeholderValue: 'Select a department',
            ...CHOICE_CONFIG
        });
    </script>


</body>


</html>