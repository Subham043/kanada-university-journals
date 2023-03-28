<script src="<?php echo base_url('assets/admin/js/pages/Jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/pages/just-validate.production.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/pages/iziToast.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/libs/simplebar/simplebar.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/libs/node-waves/waves.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/libs/feather-icons/feather.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/pages/plugins/lord-icon-2.1.0.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/pages/axios.min.js'); ?>"></script>
    <script type="text/javascript">
        const errorToast = (message) => {
            iziToast.error({
                title: 'Error',
                message: message,
                position: 'bottomCenter',
                timeout: 7000
            });
        }
        const successToast = (message) => {
            iziToast.success({
                title: 'Success',
                message: message,
                position: 'bottomCenter',
                timeout: 6000
            });
        }

        const spinner = `
                <span class="d-flex align-items-center">
                    <span class="spinner-border flex-shrink-0" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </span>
                    <span class="flex-grow-1 ms-2">
                        Loading...
                    </span>
                </span>
            `;
    </script>
    <script type="text/javascript">
        <?php if ($this->session->flashdata('success')) { ?>

            successToast('<?php echo $this->session->flashdata('success') ?>');

        <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>

            errorToast('<?php echo $this->session->flashdata('error') ?>');

        <?php } ?>
    </script>

    <!-- particles js -->
    <script src="<?php echo base_url('assets/admin/libs/particles.js/particles.js'); ?>"></script>
    <!-- particles app js -->
    <script src="<?php echo base_url('assets/admin/js/pages/particles.app.js'); ?>"></script>