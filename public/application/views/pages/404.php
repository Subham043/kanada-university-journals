<!DOCTYPE html>
<html dir="ltr" lang="en">

<?php $this->load->view('includes/head') ?>

<body class="has-side-panel side-panel-right fullwidth-page side-push-panel">

<div id="wrapper" class="clearfix">
  <!-- preloader -->
  <?php $this->load->view('includes/loader') ?>
  
  <!-- Start main-content -->
  <div class="main-content">
    <!-- Section: home -->
    <section id="home" class="divider fullscreen bg-lightest">
      <div class="display-table text-center">
        <div class="display-table-cell">
          <div class="container pt-0 pb-0">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <h1 class="font-150 text-theme-colored mt-0 mb-0"><i class="fa fa-map-signs text-gray-silver"></i>404!</h1>
                <h2 class="mt-0">Oops! Page Not Found</h2>
                <p>The page you were looking for could not be found.</p>
                <a class="btn btn-border btn-gray btn-transparent btn-circled smooth-scroll-to-target" href="#contact">Return Home</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
  
  <!-- Footer -->
  <?php $this->load->view('includes/footer'); ?>
<!-- end wrapper -->

<?php $this->load->view('includes/script'); ?>

</body>

</html>