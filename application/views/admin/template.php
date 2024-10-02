<?php $this->load->view('admin/template/header'); ?>

<?php $this->load->view('admin/template/sidebar'); ?>


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <?php $this->load->view('admin/template/navbar'); ?>
    <?php echo $contents; ?>
</main>
<?php $this->load->view('admin/template/formpengajuan'); ?>
<?php $this->load->view('admin/template/footer'); ?>