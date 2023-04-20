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
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0"><?php echo $page_name; ?></h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div id="customerList">
                                        <div class="row g-4 mb-3">
                                            <div class="col-sm-auto">
                                                <div>
                                                    <a href="<?php echo base_url('article/create'); ?>"
                                                        style="background:green;border-color:green;" type="button"
                                                        class="btn btn-success add-btn" id="create-btn"><i
                                                            class="ri-add-line align-bottom me-1"></i> Create</a>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                
                                            </div>
                                        </div>
                                        <div class="table-responsive table-card mt-3 mb-1">
                                            <?php if(count($data)){ ?>
                                            <table class="table align-middle table-nowrap" id="customerTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sort" data-sort="customer_name"><?php echo $page_name; ?> Title</th>
                                                        <th class="sort" data-sort="customer_name"><?php echo $page_name; ?> Name</th>
                                                        <th class="sort" data-sort="customer_name">Publish Date of <?php echo $page_name; ?></th>
                                                        <th class="sort" data-sort="customer_name"><?php echo $page_name; ?> ISBN/ISSN</th>
                                                        <th class="sort" data-sort="date">Created Date</th>
                                                        <th class="sort" data-sort="action">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">

                                                    <?php foreach($data as $item) { ?>
                                                    <tr>
                                                        <td class="customer_name"><?php echo $item->title; ?></td>
                                                        <td class="customer_name"><?php echo $item->name; ?></td>
                                                        <td class="customer_name"><?php echo $item->date; ?></td>
                                                        <td class="customer_name"><?php echo $item->isbn; ?></td>
                                                        <td class="date"><?php echo $item->timestamp; ?></td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <a href="<?php echo base_url('article/edit/'.$this->encryption_url->safe_b64encode($item->id)); ?>"
                                                                        style="background:yellow;color:black;border-color:yellow;"
                                                                        class="btn btn-sm btn-success edit-item-btn">Edit</a>
                                                                </div>
                                                                <div class="remove">
                                                                    <button
                                                                        class="btn btn-sm btn-danger remove-item-btn"
                                                                        style="background:red"
                                                                        onclick="deleteHandler('<?php echo base_url('article/delete/'.$this->encryption_url->safe_b64encode($item->id)); ?>')">Delete</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                            <?php }else{ ?>
                                                <?php $this->load->view('includes/no_result'); ?>
                                            <?php } ?>
                                        </div>

                                        <?php echo $links; ?>
                                    </div>
                                </div><!-- end card -->
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

            function deleteHandler(url){
                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Hey',
                    message: 'Are you sure about that?',
                    position: 'center',
                    buttons: [
                        ['<button><b>YES</b></button>', function (instance, toast) {

                            window.location.replace(url);
                            // instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }, true],
                        ['<button>NO</button>', function (instance, toast) {

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }],
                    ],
                    onClosing: function(instance, toast, closedBy){
                        console.info('Closing | closedBy: ' + closedBy);
                    },
                    onClosed: function(instance, toast, closedBy){
                        console.info('Closed | closedBy: ' + closedBy);
                    }
                });
            }

    </script>


</body>


</html>