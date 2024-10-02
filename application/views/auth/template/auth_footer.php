<!-- container-scroller -->
<!-- base:js -->
<script src="<?= base_url('aset/baseaset/') ?>vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<script src="<?= base_url('aset/baseaset/') ?>js/jquery.cookie.js" type="text/javascript"></script>
<!-- inject:js -->
<script src="<?= base_url('aset/baseaset/') ?>js/off-canvas.js"></script>
<script src="<?= base_url('aset/baseaset/') ?>js/hoverable-collapse.js"></script>
<script src="<?= base_url('aset/baseaset/') ?>js/template.js"></script>
<!-- endinject -->
<!--   Core JS Files   -->
<script src="<?= base_url('aset/baseaset/') ?>assets/js/core/popper.min.js"></script>
<script src="<?= base_url('aset/baseaset/') ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url('aset/baseaset/') ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= base_url('aset/baseaset/') ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>