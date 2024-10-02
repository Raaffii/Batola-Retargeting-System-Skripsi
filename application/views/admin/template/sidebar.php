<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header" style="text-align: center;">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
            <img src="<?= base_url('aset/bg.png') ?>" class="navbar-brand-img h-100" alt="main_logo">
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url("barang") ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url("custom") ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-gears"></i>
                    </div>
                    <span class="nav-link-text ms-1">Custom</span>

                </a>
            </li>
            <li class="nav-item">
                <a id="link" class="nav-link text-white" href="<?= base_url("barang/rekomendasi") ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Rekomendasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url("barang/pengolahanDataBarang") ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">view_in_ar</i>
                    </div>
                    <span class="nav-link-text ms-1">Pengolahan Data Barang</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= base_url("auth/logout") ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
            </li>

        </ul>
    </div>
    <script>
        // Temukan semua elemen dengan kelas 'nav-link' di dalam sidebar
        const navLinks = document.querySelectorAll('.nav-link');

        // Loop melalui setiap elemen dan tambahkan event listener untuk mengubah kelas saat diklik
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Hapus kelas 'active' dari semua elemen
                navLinks.forEach(navLink => {
                    navLink.classList.remove('active');
                });
                // Tambahkan kelas 'active' ke elemen yang sedang diklik
                this.classList.add('bg-gradient-primary');
            });
        });
    </script>




</aside>