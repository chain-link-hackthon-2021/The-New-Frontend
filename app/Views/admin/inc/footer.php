<!-- ======= Footer ======= -->
<style>
[v-cloak] {
    display: none;
}
</style>
<footer id="footer" class="footer">
    <div class="copyright">
        <input type="hidden" name="" value="<?= getenv("soapBaseUrl"); ?>" id="base_url">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">

        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= base_url() ?>/front/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url() ?>/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>/front/vendor/chart.js/chart.min.js"></script>
<script src="<?= base_url() ?>/front/vendor/echarts/echarts.min.js"></script>
<script src="<?= base_url() ?>/front/vendor/quill/quill.min.js"></script>
<script src="<?= base_url() ?>/front/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?= base_url() ?>/front/vendor/tinymce/tinymce.min.js"></script>
<script src="<?= base_url() ?>/front/vendor/php-email-form/validate.js"></script>
<script src="/js/vue3.tests.js"></script>
<script src="/js/axios.min.js"></script>
<script src="<?= base_url() ?>/front/js/app.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Template Main JS File -->
<script src="<?= base_url() ?>/front/js/main.js"></script>
<script>
var myTable = document.querySelector("#admintable");
setTimeout(() => {
    new DataTable(myTable);
}, 2000);
</script>
</body>

</html>