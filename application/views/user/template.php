<?php $this->load->view('user/template/header'); ?>



<?php $this->load->view('user/template/sidebar'); ?>


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <?php $this->load->view('user/template/navbar'); ?>
    <?php echo $contents; ?>
</main>



<?php $this->load->view('user/template/footer'); ?>